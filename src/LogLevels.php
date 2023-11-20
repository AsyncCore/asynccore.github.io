<?php
    namespace src;
    
    /**
     * Enum con los tipos de mensajes de log.
     * Puede ser: "INFO", "WARNING", "ERROR", "EXCEPTION" o "DEBUG".
     * El caso default si no se proporciona uno es "LOG".
     *
     * @see     Logger
     * @author  Daniel Alonso Lázaro <dalonsolaz@gmail.com>
     * @access  public
     * @package src
     */
    enum LogLevels: string
    {
        case INFO = "INFO";
        case WARNING = "WARNING";
        case ERROR = "ERROR";
        case EXCEPTION = "EXCEPTION";
        case DEBUG = "DEBUG";
        case DEFAULT = "LOG";
    }