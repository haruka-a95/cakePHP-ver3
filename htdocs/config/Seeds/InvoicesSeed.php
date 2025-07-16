<?php
use Migrations\AbstractSeed;

class InvoicesSeed extends AbstractSeed
{
    public function run(): void
    {
        $data = [
            [
                'title' => 'Website Development',
                'amount' => 150000.00,
                'due_date' => '2025-08-01',
                'status' => 'unpaid',
            ],
            [
                'title' => 'Hosting Fee',
                'amount' => 12000.00,
                'due_date' => '2025-08-10',
                'status' => 'paid',
            ],
            [
                'title' => 'Consulting Service',
                'amount' => 80000.00,
                'due_date' => '2025-07-31',
                'status' => 'pending',
            ],
            [
                'title' => 'Maintenance Fee',
                'amount' => 30000.00,
                'due_date' => '2025-08-05',
                'status' => 'unpaid',
            ],
            [
                'title' => 'Design Work',
                'amount' => 50000.00,
                'due_date' => '2025-08-15',
                'status' => 'paid',
            ],
        ];

        $table = $this->table('invoices');
        $table->insert($data)->save();
    }
}
