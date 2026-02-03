@echo off
REM ---- Path to your XAMPP PHP ----
SET PHP_PATH=C:\xampp\php\php.exe

REM ---- Default host and port ----
SET HOST=localhost
SET PORT=8000

REM ---- Check if user passed "LAN" argument ----
IF /I "%1"=="LAN" (
    REM Get local IP address for LAN
    FOR /F "tokens=2 delims=:" %%A IN ('ipconfig ^| findstr /R "IPv4" ^| findstr /V "169.254"') DO (
        FOR /F "tokens=1 delims= " %%B IN ("%%A") DO SET HOST=%%B
        GOTO :IPFound
    )
    :IPFound
    ECHO Starting PHP development server on LAN: http://%HOST%:%PORT%
) ELSE (
    ECHO Starting PHP development server on localhost: http://%HOST%:%PORT%
)

REM ---- Start PHP server ----
"%PHP_PATH%" -S %HOST%:%PORT% -t src/public

pause
