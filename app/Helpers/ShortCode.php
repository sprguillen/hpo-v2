<?php

namespace App\Helpers;

/**
 * Short code generator
 *
 * This is based on Flickr's shortcode implementation.
 * Details here: http://www.flickr.com/groups/api/discuss/72157616713786392/
 */
class ShortCode {
  /**
   * Once set and used, this should never be changed.
   */
  const ALPHABET = 'abcdefghijkmnopqrstuvwxyz123456789ABCDEFGHJKLMNPQRSTUVWXYZ';

  /**
   * Encodes an integer into a short code string.
   *
   * @param int    $num
   * @param string $alphabet The alphabet string to use. If this is not given, {@link ALPHABET}
   *   will be used.
   *
   * @return string
   */
  public static function intToCode($num, $alphabet = null)
  {
    if (!$alphabet) {
      $alphabet = self::ALPHABET;
    }
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
  public static function codeToInt($code, $alphabet = null)
  {
    if (!$alphabet) {
      $alphabet = self::ALPHABET;
    }

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