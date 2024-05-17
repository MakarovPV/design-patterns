<?php
/**
 * Команда – это поведенческий паттерн проектирования, который превращает запросы в объекты, позволяя передавать их как аргументы при вызове методов,
 * ставить запросы в очередь, логировать их, а также поддерживать отмену операций.

   Структура шаблона следующая. Есть конечный объект, receiver, над которым осуществляются какие-то команды, есть сами эти команды,
   как правило несколько разновидностей, и есть субъект, который применяет эти команды к конечному объекту, так называемый invoker.
   Например, есть телевизор - это конечный объект, receiver. Есть команды включить/выключить - это, собственно, команды.
   И есть пульт - это invoker, который при помощи команд переключает телевизор.
 */

/**
 * Пример 1: Управление светом в доме

 * Интерфейс команды
 */
interface Command {
    public function execute();
}

/**
 * Конкретные команды для включения и выключения света
 */
class LightOnCommand implements Command {
    private $light;

    public function __construct(Light $light) {
        $this->light = $light;
    }

    public function execute() {
        $this->light->turnOn();
    }
}

class LightOffCommand implements Command {
    private $light;

    public function __construct(Light $light) {
        $this->light = $light;
    }

    public function execute() {
        $this->light->turnOff();
    }
}

/**
 * Получатель команды - свет
 */
class Light {
    public function turnOn() {
        echo "Свет включен\n";
    }

    public function turnOff() {
        echo "Свет выключен\n";
    }
}

/**
 * Инициатор команды - пульт
 */
class RemoteControl {
    private $onCommand;
    private $offCommand;

    public function setCommands(Command $onCommand, Command $offCommand) {
        $this->onCommand = $onCommand;
        $this->offCommand = $offCommand;
    }

    public function pressOnButton() {
        $this->onCommand->execute();
    }

    public function pressOffButton() {
        $this->offCommand->execute();
    }
}

// Пример использования
$light = new Light();
$lightOnCommand = new LightOnCommand($light);
$lightOffCommand = new LightOffCommand($light);

$remoteControl = new RemoteControl();
$remoteControl->setCommands($lightOnCommand, $lightOffCommand);

$remoteControl->pressOnButton(); // Включение света
$remoteControl->pressOffButton(); // Выключение света




/**
  Пример 2: Работа с файлами

  Интерфейс команды
 */
interface CommandFile {
    public function execute();
}


/**
 * Конкретные команды для открытия и закрытия файла
 */
class FileOpenCommand implements CommandFile {
    private $file;

    public function __construct(File $file) {
        $this->file = $file;
    }

    public function execute() {
        $this->file->open();
    }
}

class FileCloseCommand implements CommandFile {
    private $file;

    public function __construct(File $file) {
        $this->file = $file;
    }

    public function execute() {
        $this->file->close();
    }
}

/**
 * Получатель команды - файл
 */
class File {
    private $name;

    public function __construct($name) {
        $this->name = $name;
    }

    public function open() {
        echo "Файл {$this->name} открыт\n";
    }

    public function close() {
        echo "Файл {$this->name} закрыт\n";
    }
}

/**
 * Инициатор команды - менеджер файлов
 */
class FileManager {
    private $openCommand;
    private $closeCommand;

    public function setCommands(CommandFile $openCommand, CommandFile $closeCommand) {
        $this->openCommand = $openCommand;
        $this->closeCommand = $closeCommand;
    }

    public function openFile() {
        $this->openCommand->execute();
    }

    public function closeFile() {
        $this->closeCommand->execute();
    }
}

// Пример использования
$file = new File("example.txt");
$fileOpenCommand = new FileOpenCommand($file);
$fileCloseCommand = new FileCloseCommand($file);

$fileManager = new FileManager();
$fileManager->setCommands($fileOpenCommand, $fileCloseCommand);

$fileManager->openFile(); // Открытие файла
$fileManager->closeFile(); // Закрытие файла