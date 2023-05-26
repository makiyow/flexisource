<?php
 
namespace App\Console\Commands;
 
use Illuminate\Console\Command;
use App\Services\CustomerImporter;
 
class ImportCustomers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'customers:import';
 
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import customers from API source.';
 
    /**
     * Execute the console command.
     */
    public function handle(CustomerImporter $customer): void
    {
        $response = $customer->import();

        if($response) {
            $this->error($response);
        } else {
            $this->info("Customer data has been imported successfully.");
        }
    }
}