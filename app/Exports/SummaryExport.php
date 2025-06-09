<?php

namespace App\Exports;

use App\Models\CompletedQuiz;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Color;
use Illuminate\Support\Collection;

class SummaryExport implements FromCollection, WithHeadings, WithMapping, WithTitle, WithStyles, WithColumnWidths, WithEvents
{
    protected $multiplayerQuizId;
    
    public function __construct($multiplayerQuizId)
    {
        $this->multiplayerQuizId = $multiplayerQuizId;
    }

    public function title(): string
    {
        return 'Quiz Summary';
    }

    public function headings(): array
    {
        return [
            'Rank',
            'Player Name',        
            'Final Score',
            'Correct Answers',
            'Wrong Answers',
            'Total Questions',
            'Started At',
            'Completed At'
        ];
    }

    public function collection()
    {
        return CompletedQuiz::with([
            'multiplayerPlayer',
            'multiplayerQuiz' => function($query) {
                $query->with(['playerAnswers' => function($subQuery) {
                    $subQuery->where('multiplayer_quiz_id', $this->multiplayerQuizId)
                        ->with('question');
                }]);
            }
        ])->where('multiplayer_quiz_id', $this->multiplayerQuizId)
        ->orderBy('score', 'desc')
        ->get()
        ->map(function($item, $index){
            $item->ranking = $index + 1;
            return $item;
        });
    }

    public function map($completedQuiz): array
    {
        $totalWrong = $completedQuiz->multiplayerQuiz->total_questions - $completedQuiz->true_answer_count;

        return [
            $completedQuiz->ranking,
            $completedQuiz->multiplayerPlayer->username,
            $completedQuiz->score,
            $completedQuiz->true_answer_count,
            $totalWrong,
            $completedQuiz->multiplayerQuiz->total_questions,
            $completedQuiz->multiplayerPlayer->joined_at ? 
                \Carbon\Carbon::parse($completedQuiz->multiplayerPlayer->joined_at)->format('M d, Y H:i') : 'N/A',
            $completedQuiz->multiplayerPlayer->finished_at ? 
                \Carbon\Carbon::parse($completedQuiz->multiplayerPlayer->finished_at)->format('M d, Y H:i') : 'N/A'
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 8,   // Rank
            'B' => 20,  // Player Name
            'C' => 18,  // Final Score
            'D' => 18,  // Correct Answers
            'E' => 18,  // Wrong Answers
            'F' => 20,  // Total Questions
            'G' => 18,  // Started At
            'H' => 18,  // Completed At
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $lastRow = $this->collection()->count() + 1;
        
        return [
            // Header row styling
            1 => [
                'font' => [
                    'bold' => true, 
                    'size' => 12,
                    'color' => ['rgb' => '1F4E79']
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'D6E3F0']
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER
                ]
            ],
            
            // All cells border and alignment
            "A1:H{$lastRow}" => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['rgb' => '9CB4D8']
                    ]
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER
                ]
            ],
            
            // Data rows styling
            "A2:H{$lastRow}" => [
                'font' => ['size' => 11],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F8FAFE']
                ]
            ],
            
            // Rank column special styling
            "A2:A{$lastRow}" => [
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => '2E5B8A']
                ]
            ],
            
            // Score column highlighting
            "C2:C{$lastRow}" => [
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => '0F5132']
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'D1E7DD']
                ]
            ]
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                
                // Set row height for header
                $sheet->getRowDimension(1)->setRowHeight(25);
                
                // Set row height for data rows
                $lastRow = $this->collection()->count() + 1;
                for ($i = 2; $i <= $lastRow; $i++) {
                    $sheet->getRowDimension($i)->setRowHeight(40);
                }
                
                // Add some padding to cells
                $sheet->getStyle("A1:H{$lastRow}")
                    ->getAlignment()
                    ->setIndent(1);
                
                // Freeze header row
                $sheet->freezePane('A2');
                
                // Auto-filter for the header row
                $sheet->setAutoFilter("A1:H{$lastRow}");
            }
        ];
    }
}