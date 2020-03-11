<?php
/* Template Name: Scheduler */
  // set timezone to local time (a little unsure about relying on this method)
  date_default_timezone_set("America/New_York");
  include("inc/scheduler_mechanics.php");

  $unlock = false;
  // Unlock is dictated by GET['menu'];
  // menu: filer => show: this
  if (isset($_GET['menu'])) {
    $unlock = true;
    $menu = $_GET['menu'];
    $show = $_GET['show'];
  }

  $search_term = "";
  if (isset($_GET['exception'])) {
    $search_term = $_GET['search'];
  }

  if (isset($_POST['submit_search'])) {
    $unlock = true;
    $menu = "search";
    $search_term = $_POST['search_term'];

    // clean
    $search_term        = trim($search_term);
    $search_term        = strip_tags($search_term);
    $search_term        = preg_replace("/[^A-Za-z0-9 ]/", '', $search_term);
    $search_term        = strtolower($search_term);
    $search_term_length = strlen($search_term);
  }

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style media="screen">

      body {
        width: 400px;
        margin: auto;
      }

      a, .user_information_toggle {
        color: #2A5DB0;
      }

      .menu_nav li a {
        text-decoration: none;
      }

      a.highlight_list_item {
        font-weight: bold;
        text-decoration: underline;
      }

      /* .container_personsDetails {
        display: none;
      } */

      span.strong {
        font-weight: bold;
      }


      /* javascript javascript javascript */
      /* these need to stay for the javascript to work */

      .toggs {display: none;}

      .cursorPointer {
        text-decoration: none;
        cursor: pointer;
      }

      .cursorPointer:hover {
        text-decoration: underline;
      }

    </style>
  </head>
  <body>

    <?php if (!$unlock) { ?>

      <p><a href="<?php echo the_permalink(); ?>?menu=available&show=now">Available now</a> <?php if (false) {echo "next available"; } ?></p>
      <hr>
      <form action="<?php echo the_permalink(); ?>" method="post">
        <input type="text" name="search_term" value="<?php echo $search_term; ?>" placeholder="search">
        <input type="submit" name="submit_search" value="search">
      </form>
      <hr>
      <h2>Days</h2>
      <ul class="menu_nav">
        <?php
        foreach ($days as $numeric_day => $verbal_day) {
          foreach ($list_days as $null_index => $day) {
            if ($verbal_day == $day) { ?>
              <li><a href="<?php the_permalink(); ?>?menu=days&show=<?php echo $day; ?>"><?php echo $day; ?></a></li>
            <?php }
          }
        } ?>

      </ul>
      <hr>
      <h2>Roles</h2>
      <ul class="menu_nav">
        <?php
          foreach ($list_roles as $role) { ?>
            <li><a href="<?php the_permalink(); ?>?menu=roles&show=<?php echo $role; ?>"><?php echo $role; ?></a></li>
        <?php } ?>
      </ul>
      <hr>
      <h2>People</h2>
      <ul class="menu_nav">
          <?php $i = 1; ?>
         <?php foreach ($list_people as $person) { ?>
           <li class="cursorPointer" id="remote<?php echo $i; ?>"><?php echo $person; ?></li>
           <!-- <li class="cursorPointer" id="remote<?php echo $i; ?>"><a href="<?php echo the_permalink(); ?>?showPerson=<?php echo urlencode($person); ?>"><?php echo $person; ?></a></li> -->
           <?php// p(list_master_person($person)); ?>
            <div class="container_personsDetails toggs" id="toggle_<?php echo $i; ?>">
              <ul>
              <?php $n = 0;  ?>
              <?php foreach (list_master_person($person) as $core => $list_values_variable) { ?>
                <?php if (!empty($list_values_variable)) { ?>
                <?php if (is_string($list_values_variable)) { ?>
                  <li><?php  echo $list_values_variable; ?></li>
                <?php } else if (is_array($list_values_variable)) {
                  foreach ($list_values_variable as $key_scheduleType => $value_list_schedule) {
                    if ($key_scheduleType == "teaching_schedule") {
                      echo "<h4>Teaching Schedule</h4>";
                      // p($value_list_schedule);
                      aggitate_teaching_schedule($value_list_schedule);
                    }
                    if ($key_scheduleType == "office_hours") {
                      echo "<h4>Office Hours</h4>";
                      aggitate_office_hours($value_list_schedule);
                    }
                  }
                } ?>

                <?php
              } else {
                  $n++;
                  if ($n > 5) {
                    echo $person . " doesn't have any details";
                  }
                }
                ?>
              <?php } ?>
              </ul>
            </div>
            <!-- Toggs toggle | container persons details -->
            <?php $i++; $count = $i; ?>
         <?php } ?>
      </ul>
      <hr>

<!-- page 2 -->
<!-- page 2 -->
<!-- page 2 -->
<!-- page 2 -->
<!-- page 2 -->
<!-- page 2 -->
<!-- page 2 -->
<!-- page 2 -->
<!-- page 2 -->

  <?php } else {
    $menu;
    $show;
  ?>
    <p><a href="<?php the_permalink(); ?>">back</a></p>
    <h2><?php echo ucwords(urldecode($menu)); ?></h2>
<!-- days  -->
<!-- days  -->
<!-- days  -->
    <?php if ($menu == "days") { ?>
      <ul class="menu_nav">
        <?php
        foreach ($days as $numeric_day => $verbal_day) {
          foreach ($list_days as $null_index => $day) {
            if ($verbal_day == $day) { ?>
              <li><a <?php if ($day == $show) {echo "class=\"highlight_list_item\" "; } ?>href="<?php the_permalink(); ?>?menu=days&show=<?php echo $day; ?>"><?php echo $day; ?></a></li>
          <?php }
          }
        } ?>
      </ul>
      <!-- menu nav -->

      <?php
      // days_details @ scheduler_mechanics: line 350
      if (!empty(days_details($show))) {
        foreach (days_details($show) as $person => $list_schedule) {
          echo "<h3>{$person}</h3>";

          // parse core pulls/pushes the main four: role, email, number, website
          parse_core(list_master_person($person));

          foreach ($list_schedule as $schedule_type => $list_details) {
            if ($schedule_type == "teaching_schedule") {
              echo "<h4>Teaching Periods</h4>";
              echo "<p>";
              foreach ($list_details as $null_index => $period) {
                echo "{$period}</li>";
                if ($period !== end($list_details)) {
                  echo ", ";
                }
              }
              echo "</p>";
            }
            if ($schedule_type == "office_hours") {
              echo "<h4>Office Hours</h4>";
              foreach ($list_details as $null_index => $list_port) {
                foreach ($list_port as $port => $time) {
                  $time = date('g:i a', strtotime($time));
                  echo $time;
                  if ($port == "start") {
                    echo " to ";
                  }
                  if ($port == "end") {
                    echo "<br>";
                  }
                }
              }
            }
          }
        }
      } else {
        echo "There are no events scheduled for " . ucfirst($show) . ".";
        echo "<br><br>";
        echo "Would you like to search for <a href=\"";
        the_permalink();
        echo "?search={$show}&exception=wildcard\">{$show}</a>?";
      }
      ?>

    <?php } ?>


<!-- ROLES ROLES ROLES  -->
<!-- ROLES ROLES ROLES  -->
<!-- ROLES ROLES ROLES  -->
    <?php if ($menu == "roles") { ?>
      <ul class="menu_nav">
        <?php
          foreach ($list_roles as $role) { ?>
            <li><a <?php if ($role == $show) {echo "class=\"highlight_list_item\"";} ?> href="<?php the_permalink(); ?>?menu=roles&show=<?php echo $role; ?>"><?php echo $role; ?></a></li>
        <?php } ?>
        <?php schedule_details($show); ?>
      </ul>
    <?php } // end days ?>


<!-- search search search -->
<!-- search search search -->
<!-- search search search -->
    <?php if ($menu == "search") { ?>
      <form action="<?php echo the_permalink(); ?>" method="post">
        <input type="text" name="search_term" value="<?php echo $search_term; ?>" placeholder="search" required>
        <input type="submit" name="submit_search" value="search">
      </form>
      <hr>
      <?php
  // EXPLICIT SEARCH TERMS
  // EXPLICIT SEARCH TERMS
      // check if search term was explicitly a day of the week
      foreach ($days as $day) {
        if ($search_term == $day) {
          echo "<p><a href=\"";
          the_permalink();
          echo "?menu=days&show={$day}\"><b>View " . $day . " schedules</b></a></p>";
        }
      }
      // check if search term was explicitly a Role
      foreach ($list_master_roles as $role) {
        if ($search_term == $role) {
          echo "<p><a href=\"";
          the_permalink();
          echo "?menu=roles&show={$role}\"><b>View schedules by role: ".$role."</b></a></p>";
        }
      }
    // /EXPLICIT-SEARCH-TERMS
    // /EXPLICIT-SEARCH-TERMS
    // /EXPLICIT-SEARCH-TERMS

      // begin natural search Clear through Empty Gate
      if ($search_term != null && $search_term_length > 0) {
        $list_of_keys = array();
        // master search loop || loop through everything: role > person > details
        foreach ($list_master as $null_role => $list_people) {
          // loop through person > their details
          foreach ($list_people as $person => $list_person_details) {
            // backend lowercase name as new variable for preserved call
            $clean_person = strtolower($person);
            // IF NAME
            if (strpos($clean_person, $search_term) !== false) {
              $list_of_keys[] = $person;
            }
            // IF NAME
            // -- loop through their details: email, phone, teaching_schedule[], office_hours[] => string / array
            foreach ($list_person_details as $key_personal_details => $value_personalDetails) {
              // deal with the strings
              if ($key_personal_details == "email") {
                if (strpos($value_personalDetails, $search_term) !== false) {
                  $list_of_keys[] = $value_personalDetails;
                }
              } // (if email) via is_string
              if ($key_personal_details == "phone") {
                // strip phone
                // 352-000-0000 => 3520000000 to enable less choosy find
                $value_personalDetails = str_replace("-","",$value_personalDetails);
                // if number exists in master
                if (strpos($value_personalDetails, $search_term) !== false) {
                  // reformat the stripped phone number
                  if (preg_match('/^(\d{3})(\d{3})(\d{4})$/', $value_personalDetails,  $pattern_match)) {
                    $newnum = $pattern_match[1] . '-' .$pattern_match[2] . '-' . $pattern_match[3];
                  }
                  $list_of_keys[] = $newnum;
                } // (if number exists in master)
              } // (if phone) via is_string
            } // overall details loop: email, phone
          } // people as person => details
        } // master search loop /searchLoop /searchLoop /searchLoop

        foreach(search($list_of_keys) as $name => $null_details) {
          parse_search($name, list_master_person($name));
        }

        if (empty($list_of_keys)) {
          echo "<p>Your search for \"<span class=\"strong\">{$search_term}</span>\" returned zero results!</p><p>Please try searching again or <a href=\"";
          the_permalink();
          echo "\">check the index page</a> to find what you're looking for!</p>";
        }

      } else {
        echo "<p>Your search was empty!</p><p>Please try searching again or <a href=\"";
        the_permalink();
        echo "\">check the index page</a> to find what you're looking for!</p>";
      }
    } // /SEARCH /SEARCH /SEARCH

// avaiable now
  // p($_GET);
  // p($list_master);

    if ($menu == "available") {
      if (is_array(clock_available_now())) {
        foreach (clock_available_now() as $person => $schedule) {
          echo "<h4>{$person}</h4>";
          parse_core(list_master_person($person));
          foreach ($schedule as $schedule_type => $port_time) {

            if ($schedule_type == "teaching_schedule") {
              echo "<h5>Teaching Now</h5>";
              echo "From " . $port_time['open'];
              echo " to "  . $port_time['close'];
            }

            if ($schedule_type == "office_hours") {
              echo "<h5>Office Hours Now</h5>";
              echo "From " . $port_time['start'];
              echo " to "  . $port_time['end'];
            }
          }
        }
      } else { // if it's a string -- meaning there were no results
        echo clock_available_now();
      }
    } // /if (menu == avaiable)

  ?>

  <?php } // END /2 /2 /2 /2 /2 /2 /2 /2 ?>


    <script type="text/javascript">
      <?php for ($i = 1; $i < $count; $i++) { ?>
        let clicker<?php echo $i; ?> = document.querySelector("#remote<?php echo $i; ?>").onclick = function toggs<?php echo $i; ?> () {
          document.querySelector("#toggle_<?php echo $i; ?>").classList.toggle("toggs");
        }
      <?php } ?>
    </script>
