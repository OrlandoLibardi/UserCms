<?php

namespace OrlandoLibardi\UserCms\app\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Composer;

class UserOlCmsCommand extends Command{


   /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'OlCMS:update';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Atualiza arquivos do Auth de acordo com a necessidade do OLCMS';
    /**
     * The Composer instance.
     *
     * @var \Illuminate\Foundation\Composer
     */
    protected $composer;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->composer = $composer;
    }


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {


        //Rotina Make:auth normal   
        $this->info('Trabalhando no Auth padrão...');

        $this->call('make:auth');
        //Apos o auth substituir os arquivos
        $files = [
            resource_path('views/auth/login.blade.php'), 
            resource_path('views/auth/register.blade.php'),
            resource_path('views/auth/passwords/email.blade.php'),
            resource_path('views/auth/passwords/reset.blade.php'),
            //app_path('/User.php')
        ];
        //exibir todos os itens que serão substituídos
        $this->info('Listando arquivos a serem atualizados:');
        
        foreach($files as $file){
            $this->info( $file );
        }        
        /*
            Confirmar a exclusão dos arquivos e publicar os novos
        */
        if( $this->confirm('Tudo certo?') )
        {
            foreach($files as $file){
                @unlink( $file );
            }

            $this->call('vendor:publish --provider="OrlandoLibardi\UserCms\app\Providers\OlCmsUserServiceProvider" --tag="adminUser"');
            $this->call('vendor:publish --provider="Spatie\Permission\PermissionServiceProvider" --tag="config"');
            $this->call('vendor:publish --provider="Spatie\Permission\PermissionServiceProvider" --tag="migrations"');

            $this->call('migrate');
    
            $this->composer->dumpAutoloads();

            $this->call('db:seed --class=PermissionTableSeeder');    
            $this->call('db:seed --class=UserCmsTableSeeder');
    
            $this->info('Concluído!');

        }   

        

        return 0;
        
    }
}


