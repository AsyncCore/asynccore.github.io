<?php

    namespace src\utils;

    /**
     * Enum con los tipos de mensajes de log.
     * Puede ser: "INFO", "WARNING", "ERROR", "EXCEPTION" o "DEBUG".
     */
    enum LogLevels: string
    {
        case INFO = "INFO";
        case WARNING = "WARNING";
        case ERROR = "ERROR";
        case EXCEPTION = "EXCEPTION";
        case DEBUG = "DEBUG";
    }