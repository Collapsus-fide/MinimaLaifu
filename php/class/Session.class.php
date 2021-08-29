<?php

class SessionException extends Exception {
}

class Session {
    static public function start() {
        switch (session_status()) {
            case PHP_SESSION_DISABLED : 
                throw new SessionException("Erreur : les session ne peuvent pas s'activer sur ce serveur.") ;
                break ;

            case PHP_SESSION_NONE : 
               
                if (headers_sent($file, $line))
                    throw new SessionException("Erreur : L'entête à déjà été envoyé. Veuillez recharger la page.") ;
               
                session_start() ;
                break ;

            case PHP_SESSION_ACTIVE : 
                break ;

            default : 
                throw new RuntimeException("Erreur : Session Introuvable.") ;
                break ;
        }
    }
}

