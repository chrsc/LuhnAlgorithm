<?php

use chrsc\LuhnAlgorithm\LuhnAlgorithm;

class LuhnTest extends PHPUnit_Framework_TestCase {
  /**
  *  @test
  */
  public function testLuhnCanValidate() {
    $luhn = new LuhnAlgorithm;
    $this->assertTrue($luhn->validate(6046464401047221));
  }

  /**
  *  @test
  */
  public function testLuhnDoesntValidate() {
    $luhn = new LuhnAlgorithm;
    $this->assertFalse($luhn->validate(6046460470333788));
  }

}
