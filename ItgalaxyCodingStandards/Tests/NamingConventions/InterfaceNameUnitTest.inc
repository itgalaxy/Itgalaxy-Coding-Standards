<?php

interface TemplateInterface
{
    public function setVariable($name, $var);
    public function getHtml($template);
}

interface InterfaceTemplate
{
    public function setVariable($name, $var);
    public function getHtml($template);
}

interface StrangeName
{
    public function setVariable($name, $var);
    public function getHtml($template);
}
