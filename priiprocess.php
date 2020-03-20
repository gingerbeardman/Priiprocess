<?php
error_reporting(E_ALL);

// text not html
header('Content-Type:text/plain');

$fp = array();
$var = array();
$ini = "";
$prii = "";
if ( count($argv) == 1 ) {
	echo "Usage: priiprocess.php Theme\n";
	exit;
} else {
	$theme = $argv[1];
}

$ret = priiprocess( "$theme/$theme.prii" );
file_put_contents( "$theme.ini", $ini );
file_put_contents( "$theme.prii.ini", $prii );
$message = ($ret) ? 'ERROR!' : 'done';
echo "\nPriiprocess: $theme $message\n";

// main
function priiprocess( $file ) {
	global $fp, $var, $ini, $prii, $theme;
	$n = 0;

	$mark_comment = ';';
	$mark_EOF = ';EOF';
	$mark_variable = '.';
	$mark_declaration = ':';
	
	$fp["$file"] = fopen($file, "r+");
	
	// read each line of file
	while(! feof($fp["$file"]))  {
		$n++;
		
		$line = fgets($fp["$file"]);
		$line = trim($line);

		if ( $line ) {
			// early termination marker
			if ( $line == $mark_EOF ) {
				break;

			// comment marker
			} elseif ( $line[0] == $mark_comment ) {
				// $variable \t declaration
				if ( $line[1] == $mark_variable && strpos($line, $mark_declaration) ) {
					$line = preg_replace("/\s{2,}/", '', $line);
					list($key, $val) = explode($mark_declaration, $line);
					$key = str_replace($mark_comment, '', trim($key));
					$val = trim($val);

					// temp store variable
					$var[$key] = $val;
				}

			// $variable line
			} elseif ($line[0] == $mark_variable) {
				// include file
				if ( substr( $var[$line], 0, 4) == 'inc.' ) {
					if ( file_exists("$theme/".$var[$line]) ) {
						priiprocess("$theme/".$var[$line]);
					} else {
						echo "\n$file@$n: (missing) $theme/$var[$line]\n";
						return 404;
					}
					
				// line as-is
				} else {
					$ini .= "$var[$line]\n";
					$prii .= "$line\n";
				}

			// output line
			} else {
				if ( $line[0] == '[' ) {
					$ini .= "\n$line\n";
					$prii .= "\n$line\n";
				} else {
					$ini .= "$line\n";
					$prii .= "$line\n";
				}
			}
		}
	}
	
	fclose($fp["$file"]);
	
	return 0;
}

?>