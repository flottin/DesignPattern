<?php

class Translator
{
  private $locale;

  public function __construct($locale)
  {
    echo 'init translator with locale : ' . $locale . "\n";
  }

  public function t($key)
  {
    echo 'get key : ' . $key  . "\n";
    return $key   . "\n";
  }
}

class TranslatorProxy
{
  private $translator;

  private $keys;

  private $locale;

  public function __construct($locale)
  {
    $this->locale = $locale;
  }

  public function t($key)
  {
    if (empty($this->translator))
    {
      $this->translator = new Translator($this->locale);
    }
    if (isset($this->keys[$key]))
    {
      return $this->keys[$key];
    }
    else
    {
      $this->keys[$key] = $this->translator->t($key);
      return $this->keys[$key];
    }
  }
}


class View
{
  private $translator;
  public function __construct()
  {
    $this->translator = new TranslatorProxy('fr');
    //$this->translator = new Translator('fr');
  }
  public function t($key)
  {
    return $this->translator->t($key);
  }
}

$view = new View();
$view->locale = 'locale : fr' . "\n";

echo $view->t('à partir de');
echo $view->t('à partir de');
echo $view->t('à partir de');
echo $view->t('à');
echo $view->t('à partir de');
echo $view->t('à partir de');
echo $view->t('à');

echo $view->t('à');

echo $view->locale;
