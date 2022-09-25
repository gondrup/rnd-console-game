<?php

namespace App\Game;

class Images
{
    public static function getImageForLetter(?string $letter): string
    {
        return match (strtoupper($letter ?? '')) {
            'A' => self::LETTER_A,
            'B' => self::LETTER_B,
            'C' => self::LETTER_C,
            'D' => self::LETTER_D,
            'E' => self::LETTER_E,
            'F' => self::LETTER_F,
            'G' => self::LETTER_G,
            'H' => self::LETTER_H,
            'J' => self::LETTER_J,
            'K' => self::LETTER_K,
            'L' => self::LETTER_L,
            'M' => self::LETTER_M,
            'N' => self::LETTER_N,
            'O' => self::LETTER_O,
            'P' => self::LETTER_P,
            'Q' => self::LETTER_Q,
            'R' => self::LETTER_R,
            'S' => self::LETTER_S,
            'T' => self::LETTER_T,
            'U' => self::LETTER_U,
            'V' => self::LETTER_V,
            'W' => self::LETTER_W,
            'X' => self::LETTER_X,
            'Y' => self::LETTER_Y,
            'Z' => self::LETTER_Z,
            default => self::LETTER_UNKNOWN,
        };
    }

    public static function getImageForMan(int $remainingGuesses): string
    {
        return match ($remainingGuesses) {
            0 => self::MAN_0,
            1 => self::MAN_1,
            2 => self::MAN_2,
            3 => self::MAN_3,
            4 => self::MAN_4,
            5 => self::MAN_5,
            6 => self::MAN_6,
            7 => self::MAN_7,
            default => self::MAN_8,
        };
    }

    public const HANGMAN = <<<EOT
 ███   ███  ▄███████▄  ███   ███  ▄████████
 ███   ███  ███▀▀▀███  ███▄  ███  ███       
 ███   ███  ███   ███  █████▄███  ███       
 █████████  █████████  █████████  ███  ███▄
 ███   ███  ███   ███  ███▀█████  ███   ███
 ███   ███  ███   ███  ███  ▀███  ███   ███
 ███   ███  ███   ███  ███   ███  ███   ███
 ███   ███  ███   ███  ███   ███  █████████

      ███▄ ▄███  ▄███████▄  ███   ███     
      █████████  ███▀▀▀███  ███▄  ███     
      ███ ▀ ███  ███   ███  █████▄███     
      ███   ███  █████████  █████████     
      ███   ███  ███   ███  ███▀█████     
      ███   ███  ███   ███  ███  ▀███     
      ███   ███  ███   ███  ███   ███     
      ███   ███  ███   ███  ███   ███
EOT;

    public const LETTER_UNKNOWN = <<<EOT
     
     
▄▄▄▄▄
EOT;

    public const LETTER_A = <<<EOT
▄▀▀▀▄
█▀▀▀█
█   █
EOT;

    public const LETTER_B = <<<EOT
█▀▀▀▄
█▀▀▀▄
█▄▄▄▀
EOT;

    public const LETTER_C = <<<EOT
▄▀▀▀▀
█    
▀▄▄▄▄
EOT;

    public const LETTER_D = <<<EOT
█▀▀▀▄
█   █
█▄▄▄▀
EOT;

    public const LETTER_E = <<<EOT
█▀▀▀▀
█▀▀▀ 
█▄▄▄▄
EOT;

    public const LETTER_F = <<<EOT
█▀▀▀▀
█▀▀▀ 
█    
EOT;

    public const LETTER_G = <<<EOT
█▀▀▀▀
█  ▀█
█▄▄▄█
EOT;

    public const LETTER_H = <<<EOT
█   █
█▀▀▀█
█   █
EOT;

    public const LETTER_I = <<<EOT
▀▀█▀▀
  █   
▄▄█▄▄
EOT;

    public const LETTER_J = <<<EOT
▀▀█▀▀
  █  
█▄█  
EOT;

    public const LETTER_K = <<<EOT
█  ▄▀
█▀█  
█  ▀▄
EOT;

    public const LETTER_L = <<<EOT
█    
█    
█▄▄▄▄
EOT;

    public const LETTER_M = <<<EOT
█▄ ▄█
█ ▀ █
█   █
EOT;

    public const LETTER_N = <<<EOT
█▄  █
█ █ █
█  ▀█
EOT;

    public const LETTER_O = <<<EOT
▄▀▀▀▄
█   █
▀▄▄▄▀
EOT;

    public const LETTER_P = <<<EOT
█▀▀▀▄
█▀▀▀ 
█    
EOT;

    public const LETTER_Q = <<<EOT
▄▀▀▀▄
█ ▄ █
▀▄▄██
EOT;

    public const LETTER_R = <<<EOT
█▀▀▀▄
█▀█▀ 
█  ▀▄
EOT;

    public const LETTER_S = <<<EOT
▄▀▀▀▀
▀▀▀▀▄
▄▄▄▄▀
EOT;

    public const LETTER_T = <<<EOT
▀▀█▀▀
  █  
  █  
EOT;

    public const LETTER_U = <<<EOT
█   █
█   █
▀▄▄▄▀
EOT;

    public const LETTER_V = <<<EOT
█   █
█   █
 ▀▄▀ 
EOT;

    public const LETTER_W = <<<EOT
█   █
█ ▄ █
▀▄▀▄▀
EOT;

    public const LETTER_X = <<<EOT
▀▄ ▄▀
  █  
▄▀ ▀▄
EOT;

    public const LETTER_Y = <<<EOT
▀▄ ▄▀
  █  
  █  
EOT;

    public const LETTER_Z = <<<EOT
▀▀▀▀█
 ▄▄▀ 
█▄▄▄▄
EOT;

    public const MAN_8 = <<<EOT
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
 ▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄
EOT;

    public const MAN_7 = <<<EOT
              ▀▀▀▀▀▀▀▀▀▀▀█  
                         █  
                         █  
                         █  
                         █  
                         █  
                         █  
                         █  
                         █  
                         █  
                         █  
                         █  
                         █  
                         █  
                         █  
                         █  
                         █  
                         █  
 ▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄█▄▄
EOT;

    public const MAN_6 = <<<EOT
              █▀▀▀▀▀▀▀▀▀▀█  
              █          █  
                         █  
                         █  
                         █  
                         █  
                         █  
                         █  
                         █  
                         █  
                         █  
                         █  
                         █  
                         █  
                         █  
                         █  
                         █  
                         █  
 ▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄█▄▄
EOT;

    public const MAN_5 = <<<EOT
              █▀▀▀▀▀▀▀▀▀▀█  
             ▄█▄         █  
            █   █        █  
             ▀▀▀         █  
                         █  
                         █  
                         █  
                         █  
                         █  
                         █  
                         █  
                         █  
                         █  
                         █  
                         █  
                         █  
                         █  
                         █  
 ▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄█▄▄
EOT;

    public const MAN_4 = <<<EOT
              █▀▀▀▀▀▀▀▀▀▀█  
             ▄█▄         █  
            █   █        █  
             ▀█▀         █  
              █          █  
              █          █  
              █          █  
                         █  
                         █  
                         █  
                         █  
                         █  
                         █  
                         █  
                         █  
                         █  
                         █  
                         █  
 ▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄█▄▄
EOT;

    public const MAN_3 = <<<EOT
              █▀▀▀▀▀▀▀▀▀▀█  
             ▄█▄         █  
            █   █        █  
             ▀█▀         █  
            ▄▀█          █  
          ▄▀  █          █  
              █          █  
                         █  
                         █  
                         █  
                         █  
                         █  
                         █  
                         █  
                         █  
                         █  
                         █  
                         █  
 ▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄█▄▄
EOT;

    public const MAN_2 = <<<EOT
              █▀▀▀▀▀▀▀▀▀▀█  
             ▄█▄         █  
            █   █        █  
             ▀█▀         █  
            ▄▀█▀▄        █  
          ▄▀  █  ▀▄      █  
              █          █  
                         █  
                         █  
                         █  
                         █  
                         █  
                         █  
                         █  
                         █  
                         █  
                         █  
                         █  
 ▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄█▄▄
EOT;

    public const MAN_1 = <<<EOT
              █▀▀▀▀▀▀▀▀▀▀█  
             ▄█▄         █  
            █   █        █  
             ▀█▀         █  
            ▄▀█▀▄        █  
          ▄▀  █  ▀▄      █  
              █          █  
            ▄▀           █  
          ▄▀             █  
                         █  
                         █  
                         █  
                         █  
                         █  
                         █  
                         █  
                         █  
                         █  
 ▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄█▄▄
EOT;

    public const MAN_0 = <<<EOT
              █▀▀▀▀▀▀▀▀▀▀█  
             ▄█▄         █  
            █   █        █  
             ▀█▀         █  
            ▄▀█▀▄        █  
          ▄▀  █  ▀▄      █  
              █          █  
            ▄▀ ▀▄        █  
          ▄▀     ▀▄      █  
                         █  
                         █  
                         █  
                         █  
                         █  
                         █  
                         █  
                         █  
                         █  
 ▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄█▄▄
EOT;
}