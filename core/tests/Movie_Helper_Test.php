<?php defined("SYSPATH") or die("No direct script access.");
/**
 * Gallery - a web based photo album viewer and editor
 * Copyright (C) 2000-2009 Bharat Mediratta
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or (at
 * your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street - Fifth Floor, Boston, MA  02110-1301, USA.
 */
class Movie_Helper_Test extends Unit_Test_Case {
  public function create_movie_shouldnt_allow_names_with_slash_test() {
    $rand = rand();
    $root = ORM::factory("item", 1);
    try {
      $movie = movie::create($root, DOCROOT . "core/tests/test.jpg", "$rand/.jpg", $rand, $rand);
    } catch (Exception $e) {
      // pass
      return;
    }

    $this->assert_true(false, "Shouldn't create a movie with / in the name");
  }

  public function create_movie_shouldnt_allow_names_with_trailing_periods_test() {
    $rand = rand();
    $root = ORM::factory("item", 1);
    try {
      $movie = movie::create($root, DOCROOT . "core/tests/test.jpg", "$rand.jpg.", $rand, $rand);
    } catch (Exception $e) {
      $this->assert_equal("@todo NAME_CANNOT_END_IN_PERIOD", $e->getMessage());
      return;
    }

    $this->assert_true(false, "Shouldn't create a movie with trailing . in the name");
  }
}
