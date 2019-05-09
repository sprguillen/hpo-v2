<?php

namespace App\Helpers;

/**
 * Short code generator
 *
 * This is based on Flickr's shortcode implementation.
 * Details here: http://www.flickr.com/groups/api/discuss/72157616713786392/
 */
trait ShortCodeGenerator {

  /**
   * Once set and used, this should never be changed.
   */
  private $alphabet = 'abcdefghijkmnopqrstuvwxyz123456789';

  /**
   * Encodes an integer into a short code string.
   *
   * @param int    $num
   * @param string $alphabet The alphabet string to use. If this is not given, {@link ALPHABET}
   *   will be used.
   *
   * @return string
   */
  public function intToCode($num)
  {
    $alphabet = $this->alphabet;

    $baseCount = strlen($alphabet);
    $encoded   = '';
    while ($num >= $baseCount) {
      $div     = $num / $baseCount;
      $mod     = $num - ($baseCount * intval($div));
      $encoded = $alphabet[$mod] . $encoded;
      $num     = intval($div);
    }

    if ($num) {
      $encoded = $alphabet[$num] . $encoded;
    }

    return $encoded;
  }

  /**
   * Decodes a short code into an integer.
   *
   * @param string $code
   * @param string $alphabet The alphabet string to use. If this is not given, {@link ALPHABET}
   *   will be used.
   *
   * @return int
   */
  public function codeToInt($code)
  {
    $alphabet = $this->alphabet;

    $decoded = 0;
    $multi   = 1;
    while (strlen($code) > 0) {
      $digit = $code[strlen($code) - 1];
      $decoded += $multi * strpos($alphabet, $digit);
      $multi = $multi * strlen($alphabet);
      $code  = substr($code, 0, -1);
    }

    return $decoded;
  }
}
