<?php

namespace Av\Storage;

interface Storage {

  public function init(Config $config): Promise;

}
