<?php
function template( $path = null )
{
	if (empty($path)) {
		return app('template');
	}
}

function twig( $path = null )
{
	if (empty($path)) {
		return app('twig');
	}
}

function view()
{
	return app('view');
}

function assets( $path )
{
  return view()->asset( $path );
}

function settings( $foo )
{
	return '';
}