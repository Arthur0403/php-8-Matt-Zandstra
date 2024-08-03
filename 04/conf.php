<?php

// Listing 4.62
/*xml version="l.0"
<conf>
<item name="user">bob</item>
<item name="pass">newpass</item>
<item name="host">localhost</item>
</conf>*/

class Conf
{
    private \SimpleXMLElement $xml;
    private \SimpleXMLElement $lastmatch;

    public function __construct(private string $file)
    {
        if (!file_exists($file)) {
            throw new FileException("File $file not found"); // FileException::class вместо \Exception
        }
        $this->xml = simplexml_load_file($file, null, LIBXML_NOERROR);
        if (!is_object($this->xml)) {
            throw new XmlException($this->xml->error);
        }

        $matches = $this->xml->xpath("/conf/item");
        if (!count($matches)) {
            throw new ConfException("File $file is empty");
        }
    }

    public function write(): void
    {
        if (!is_writable($this->file)) {
//            throw new \Exception("File $this->file is not writable");
            throw new FileException("File $file not found"); // FileException::class вместо \Exception
        }

        file_put_contents($this->file, $this->xml->asXML());
    }

    public function get(string $str): ?string
    {
        $matches = $this->xml->xpath("/conf/item[@name='$str']");

        if (count($matches)) {
            $this->lastmatch = $matches[0];
            return (string)$matches[0];
        }

        return null;
    }

    public function set(string $key, string $value): void
    {
        if (!is_null($this->get($key))) {
            $this->lastmatch[0] = $value;
            return;
        }

        $conf = $this->xml->conf;
        $conf->addChild('item', $value)->addAttribute('name', $key);
    }
}

//Usage
try {
    $conf = new Conf('resolve.xml');
    $conf->set('host', 'localhost');
    $conf->write();
} catch (\Exception $e) {
    echo $e->getMessage();
    // или, если нельзя восстановить работу после ошибки, выбрасываем новое исключение
    throw new \Exception("Ошибка конфигурации" . $e->getMessage());
}

// Расширим класс Exception
class XmlException extends \Exception
{
    public function __construct(private \LibXMLError $error)
    {
        $shortfile = basename($error->file);
        $message = sprintf('%s:%s: %s', $shortfile, $error->line, $error->message);
        this->error = $error;
        parent::__construct($message, $error->code);
    }

    public function getLibXMLError(): \LibXMLError
    {
        return $this->error;
    }
}

class FileException extends \Exception
{
}

class ConfException extends \Exception
{
}

// Листинг 4.73
class Runner
{
    public static function init()
    {
        try {
            $conf = new Conf(DIR . "/conf.broken.xml");
            print "user: " . $conf->get('user') . "\n";
            print "host: " . $conf->get('host') . "\n";
            $conf->set("pass","newpass");
            $conf->write();
        } catch (FileException $e) {
        // Файл не существует или недоступен
        } catch (XmlException $е) {
        // Поврежденный xml
        } catch (ConfException $e) {
        // Неверный формат XML-файла
        } catch (\Exception $e) {
        // Ловушка: этот код не должен вызываться
        } finally {
            print "finally\n";
//            fclose($fn);
        }
    }
}
