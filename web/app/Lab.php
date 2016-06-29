<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Computer;
use App\Configuration;
use App\Rele;

class Lab extends Model
{
    protected $table = 'labs';
	protected $primaryKey = 'id';
    protected $guarded = array('id');
	protected $fillable = ['number','linux_user','linux_password','windows_user','windows_password'];


    public function computers()
	{
		return $this->hasMany(Computer::class);
    }

    public function reles()
	{
		return $this->hasMany(Rele::class);
    }

    public function shutdown()
    {
    	$configuration = Configuration::get()->first();
    	// Define porta onde arduino está conectado
        $port = $configuration->arduino_port;
        $delay =  $configuration->communication_delay;     
        // Configura velocidade de comunicação com a porta serial
        exec("MODE $port BAUD=9600 PARITY=n DATA=8 XON=on STOP=1");
        sleep($delay);
        // Inicia comunicação serial
        $fp = fopen($port, 'c+');

	     foreach($this->reles()->get() as $rele)
         {
         	fwrite($fp, $rele->pin."_on");
         	sleep($delay);
         }

         fclose($fp);

    	header('Content-Disposition: attachment; filename="script.vbs"');
		header("Cache-control: private");
		header("Content-transfer-encoding: binary\n");
		foreach($this->computers()->get() as $computer)
		{
			echo "Dim objShellUbuntu".$computer->id."\n";
			echo "Dim objShellWindows".$computer->id."\n";
			echo "Set objShellWindows".$computer->id." = WScript.CreateObject(\"WScript.Shell\")\n";
			echo "objShellWindows".$computer->id.".Run(\"\"\"".$configuration->psshutdown_path."\"\" -u ".$this->windows_user." -p ".$this->windows_password." \\\\".$computer->ip."\"\"\")\n";
			echo "Set objShellUbuntu".$computer->id." = WScript.CreateObject(\"WScript.Shell\")\n";
			echo "objShellUbuntu".$computer->id.".Run (\"\"\"".$configuration->plink_path."\"\" -ssh ".$this->linux_user."@".$computer->ip." -pw ".$this->linux_password." sudo poweroff\"\"\")\n";
		}
		
		exit;
    }

    public function power()
    {
    	$configuration = Configuration::get()->first();
    	// Define porta onde arduino está conectado
        $port = $configuration->arduino_port;
        $delay =  $configuration->communication_delay;     
        // Configura velocidade de comunicação com a porta serial
        exec("MODE $port BAUD=9600 PARITY=n DATA=8 XON=on STOP=1");
        sleep($delay);
        // Inicia comunicação serial
        $fp = fopen($port, 'c+');

        foreach($this->computers()->get() as $computer)
        {
	        sleep($delay);
	        $MACinteiro = $computer->mac;
	        $duplasdemac = explode(":", $MACinteiro);

	        foreach ($duplasdemac as $parte){
	            $parte = hexdec($parte);
	            fwrite($fp, $parte);
	            sleep($delay);
	        }

	     }
	    foreach($this->reles()->get() as $rele)
        {
        	fwrite($fp, $rele->pin."_on");
        	sleep($delay);
        }

        fclose($fp);
     }

}
