<?php
/**
 * Created by PhpStorm.
 * User: piqu0004
 * Date: 25/09/19
 * Time: 13:55
 */
require_once 'MyPDO.template.php';
require_once('Session.class.php');

class AuthenticationException extends Exception {

}
class NotInSessionException extends Exception {

}

class User
{
    private $id ;
    private $lastName ;
    private $firstName ;
    private $login ;
    private $phone ;
    public $currentProd = 1;
    
    const session_key = "__user__";

    /**
     * Constructeur privé
     * (Pour pasinstancier des objets User).
     */
    private function __construct()
    {
    }

    public function firstName(): string {
        return $this->firstName;
    }

    public function profile (){
        return "<div>Nom : ".$this->firstName."</div><div> Prénom : ".$this->lastName."</div><div> Login : ".$this->login."</div><div> Téléphone : ".$this->phone ."</div> ";
    }
   static public function loginForm( $action, $submitText = 'connexion'):string{
       $res = <<<HTML
<div>
    <form class="login-form" name="auth" method="POST" action =$action>
    <div>
    Login
    <input name="login" type="text" required/>
</div>
      <div>
      Mot de passe
      <input name="pass" type="password"  required>
</div>
      
      <button type="submit"> $submitText </button></form>
    </form>
</div>
    
HTML
       ;
        return $res;
   }

   public static function createFromAuth(array $data){
      $stmt = MyPDO::getInstance()->prepare(<<<SQL
        SELECT id, login
        FROM admin
        WHERE login = :log 
        AND sha512pass = :mdp;
SQL
           );
           $stmt->execute([':log' => $data['login'], ':mdp' =>  hash('sha512',$data['pass'])]);

           $stmt->setFetchMode(PDO::FETCH_CLASS, __CLASS__);
           
          if (($user = $stmt->fetch()) !== false){
            Session::start();
            $_SESSION[self::session_key]['connected'] = true;
          }else{ header("Location:../gestion.php?tentative=false");}
       return $user;
   }

    public static function isConnected(){
        Session::start() ;
        return (  isset($_SESSION[self::session_key]['connected']) && $_SESSION[self::session_key]['connected'])
            || (   isset($_SESSION[self::session_key]['user'])  && $_SESSION[self::session_key]['user'] 
              instanceof self ) ;
    }

    public function logoutIfRequested(){
      if (self::isConnected() && isset($_REQUEST['logout'])) {
        session_unset();
        session_destroy();
      }
    }

    public static function logoutForm(string $action, string $text){
        $text = htmlspecialchars($text, ENT_COMPAT, 'utf-8') ;
        return <<<HTML
    <form action='$action' method='POST'>
    <input type='submit' value="$text" name='logout'>
    </form>
HTML;
    }

    public function saveIntoSession(){
        Session::start() ;
        $_SESSION[self::session_key]['user'] = $this ;
    }

    public static function createFromSession(){
        Session::start() ;
        if (isset($_SESSION[self::session_key]['user'])) {
            $user = $_SESSION[self::session_key]['user'] ;
            if (is_object($user) && get_class($user) == get_class()) {
                return $user ;
            }
        }
        
        throw new NotInSessionException() ;
    }
}