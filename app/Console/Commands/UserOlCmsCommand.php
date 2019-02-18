<?php

namespace OrlandoLibardi\UserCms\app\Console\Commands;

use Illuminate\Console\Command;


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
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {


        //Rotina Make:auth normal   
        $this->info('Trabalhando no Auth padrão:');

        $this->call('make:auth');
        //Apos o auth substituir os arquivos
        $files = [
            resource_path('views/auth/login.blade.php'), 
            resource_path('views/auth/register.blade.php'),
            resource_path('views/auth/passwords/email.blade.php'),
            resource_path('views/auth/passwords/reset.blade.php'),
            app_path('/User.php')
        ];
        //exibir todos os itens que serão substituídos
        $this->info('Listando arquivos a serem atualizados:');
        
        foreach($files as $file){
            $this->info( $file );
        }        

        if( $this->confirm('Tudo certo?') ){
            foreach($files as $file){
                @unlink( $file );
            }
        }   

        return 0;
        
    }
}


