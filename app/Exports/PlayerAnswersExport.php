<?php

namespace App\Exports;

use App\Models\User;
use App\Models\MultiplayerPlayer;
use App\Models\PlayerAnswer;
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

class PlayerAnswersExport implements FromCollection, WithHeadings, WithMapping, WithTitle, WithStyles, WithColumnWidths, WithEvents
{
    protected $user;
    protected $player;
    protected $multiplayerQuizId;
    
    public function __construct(User $user, MultiplayerPlayer $player, $multiplayerQuizId)
    {
        $this->user = $user;
        $this->player = $player;
        $this->multiplayerQuizId = $multiplayerQuizId;
    }

    public function title(): string
    {
        // Clean the username for sheet name
        $cleanUsername = preg_replace('/[^A-Za-z0-9\-_]/', '', $this->player->username);
        return substr($cleanUsername, 0, 31); // Excel sheet name limit is 31 characters
    }

    public function headings(): array
    {
        return [
            'Question',
            'Result',
            'Option A',
            'Option B',
            'Option C',
            'Option D',
            'Option E',
            'Option F',
            'Your Answer',
            'Points Earned',
            'Answered At'
        ];
    }

    public function collection()
    {
        return PlayerAnswer::with('question')
            ->where('player_id', $this->user->id)
            ->where('multiplayer_quiz_id', $this->multiplayerQuizId)
            ->where('quiz_type', 'multiplayer')
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function map($playerAnswer): array
    {
        $options = json_decode($playerAnswer->question->answers, true) ?? [];
        
        $optionA = $options['answer_a'] ?? '';
        $optionB = $options['answer_b'] ?? '';
        $optionC = $options['answer_c'] ?? '';
        $optionD = $options['answer_d'] ?? '';
        $optionE = $options['answer_e'] ?? '';
        $optionF = $options['answer_f'] ?? '';

        $playerAnswerValue = '';

        // Map player answer to actual text
        switch($playerAnswer->answer) {
            case 'answer_a':
                $playerAnswerValue = $optionA ?: 'N/A';
                break;
            case 'answer_b':
                $playerAnswerValue = $optionB ?: 'N/A';
                break;
            case 'answer_c':
                $playerAnswerValue = $optionC ?: 'N/A';
                break;
            case 'answer_d':
                $playerAnswerValue = $optionD ?: 'N/A';
                break;
            case 'answer_e':
                $playerAnswerValue = $optionE ?: 'N/A';
                break;
            case 'answer_f':
                $playerAnswerValue = $optionF ?: 'N/A';
                break;
            default:
                $playerAnswerValue = 'No Answer';
        }

        return [
            $playerAnswer->question->question,
            $playerAnswer->is_correct ? '✓ Correct' : '✗ Wrong',
            $optionA,
            $optionB,
            $optionC,
            $optionD,
            $optionE,
            $optionF,
            $playerAnswerValue,
            $playerAnswer->point ?? 0,
            $playerAnswer->updated_at ? 
                \Carbon\Carbon::parse($playerAnswer->updated_at)->format('M d, Y H:i:s') : 'N/A'
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 45,  // Question
            'B' => 12,  // Result
            'C' => 30,  // Option A
            'D' => 30,  // Option B
            'E' => 30,  // Option C
            'F' => 30,  // Option D
            'G' => 30,  // Option E
            'H' => 30,  // Option F
            'I' => 30,  // Your Answer
            'J' => 18,  // Points Earned
            'K' => 18,  // Answered At
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
            
            // All cells border
            "A1:K{$lastRow}" => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['rgb' => '9CB4D8']
                    ]
                ]
            ],
            
            // Question column alignment (left)
            "A2:A{$lastRow}" => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_LEFT,
                    'vertical' => Alignment::VERTICAL_TOP,
                    'wrapText' => true
                ],
                'font' => ['size' => 11]
            ],
            
            // Options columns alignment (left)
            "C2:H{$lastRow}" => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_LEFT,
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'wrapText' => true
                ],
                'font' => ['size' => 10]
            ],
            
            // Your Answer column alignment (left)
            "I2:I{$lastRow}" => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_LEFT,
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'wrapText' => true
                ],
                'font' => [
                    'size' => 11,
                    'bold' => true
                ]
            ],
            
            // Result column center aligned
            "B2:B{$lastRow}" => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER
                ],
                'font' => ['size' => 11]
            ],
            
            // Points column center aligned
            "J2:J{$lastRow}" => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER
                ],
                'font' => ['size' => 11]
            ],
            
            // Date column center aligned
            "K2:K{$lastRow}" => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER
                ],
                'font' => ['size' => 11]
            ],
            
            // Data rows background
            "A2:K{$lastRow}" => [
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F8FAFE']
                ]
            ]
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $lastRow = $this->collection()->count() + 1;
                
                // Set row height for header
                $sheet->getRowDimension(1)->setRowHeight(25);
                
                // Set row height for data rows
                for ($i = 2; $i <= $lastRow; $i++) {
                    $sheet->getRowDimension($i)->setRowHeight(60);
                }
                
                // Add padding to cells
                $sheet->getStyle("A1:K{$lastRow}")
                    ->getAlignment()
                    ->setIndent(1);
                
                // Conditional formatting for correct/wrong answers
                for ($i = 2; $i <= $lastRow; $i++) {
                    $resultCell = $sheet->getCell("B{$i}");
                    $resultValue = $resultCell->getValue();
                    
                    if (strpos($resultValue, '✓') !== false) {
                        // Correct answer - green background
                        $sheet->getStyle("B{$i}")->applyFromArray([
                            'fill' => [
                                'fillType' => Fill::FILL_SOLID,
                                'startColor' => ['rgb' => 'D1E7DD']
                            ],
                            'font' => [
                                'color' => ['rgb' => '0F5132'],
                                'bold' => true
                            ]
                        ]);
                    } else if (strpos($resultValue, '✗') !== false) {
                        // Wrong answer - red background
                        $sheet->getStyle("B{$i}")->applyFromArray([
                            'fill' => [
                                'fillType' => Fill::FILL_SOLID,
                                'startColor' => ['rgb' => 'F8D7DA']
                            ],
                            'font' => [
                                'color' => ['rgb' => '721C24'],
                                'bold' => true
                            ]
                        ]);
                    }
                }
                
                // Freeze header row and first column
                $sheet->freezePane('B2');
                
                // Auto-filter for the header row
                $sheet->setAutoFilter("A1:K{$lastRow}");
            }
        ];
    }
}