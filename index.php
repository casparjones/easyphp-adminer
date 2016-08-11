<?php

function adminer_object()
{
	// Required to run any plugin.
	include_once "./plugins/plugin.php";

	// Plugins auto-loader.
	foreach (glob("plugins/*.php") as $filename) {
		include_once "./$filename";
	}

	// Specify enabled plugins here.
	$plugins = array(
		new AdminerDatabaseHide(array("mysql", "information_schema", "performance_schema")),
		new AdminerLoginServers(
			array(
				filter_input(INPUT_SERVER, 'SERVER_NAME'),
				'eu-cdbr-west-01.cleardb.com',
				'm60mxazb4g6sb4nn.chr7pe7iynqr.eu-west-1.rds.amazonaws.com'
			)
		),
		new AdminerSimpleMenu(),
		new AdminerCollations(array("utf8_general_ci", "utf8mb4_general_ci")),
		new AdminerJsonPreview(),

		// AdminerTheme has to be the last one.
		new AdminerTheme("default-blue"),
	);

	return new AdminerPlugin($plugins);
}

// Include original Adminer or Adminer Editor.
include "./adminer.php";
