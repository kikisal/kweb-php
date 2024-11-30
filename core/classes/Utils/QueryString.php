<?php
/*
-------------------------------------------------------------------

██████╗ ██╗   ██╗    ██╗  ██╗██╗██╗  ██╗██╗███████╗ █████╗ ██╗     
██╔══██╗╚██╗ ██╔╝    ██║ ██╔╝██║██║ ██╔╝██║██╔════╝██╔══██╗██║     
██████╔╝ ╚████╔╝     █████╔╝ ██║█████╔╝ ██║███████╗███████║██║     
██╔══██╗  ╚██╔╝      ██╔═██╗ ██║██╔═██╗ ██║╚════██║██╔══██║██║     
██████╔╝   ██║       ██║  ██╗██║██║  ██╗██║███████║██║  ██║███████╗
╚═════╝    ╚═╝       ╚═╝  ╚═╝╚═╝╚═╝  ╚═╝╚═╝╚══════╝╚═╝  ╚═╝╚══════╝
                                                                   
-------------------------------------------------------------------
                        No Comment.
*/

namespace KCoreWeb\Utils;


class QueryString extends SimpleGetter {
    public function init() : void {
        
        parent::init();

        $this->raw = @$_SERVER['QUERY_STRING'];
        
        if ( empty ( $this->raw ) )
            return;

        $tokens = explode( '&', $this->raw );

        foreach ( $tokens as $token ) {
            
            $symbol_pos = strpos( $token, '=' );

            $key        = substr( $token, 0, $symbol_pos );
            $value      = substr( $token, $symbol_pos + 1 );

            $this->items[ $key ] = $value;
        }
    }
}
