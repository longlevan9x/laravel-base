@extends('plugins.translation-manager.layout')
@section('content')
	<?php
	//	$dfLocale = request()->segment(2, null);
	//
	//	if (!array_key_exists($dfLocale, config('common.language.locales'))) {
	//		$dfLocale = config('common.language.locale');
	//	}
	/** @var string $locale */
	?>
    <div class="col-md-12">
        <div class="col-md-3">
            <ul class="nav nav-pills nav-stacked">
                @forelse(config('common.language.locales') as $_locale => $text)
                    <li role="presentation" class="@if($_locale == $locale) active @endif"><a href="{{url('translation-manager', $_locale)}}">{{$text}}</a></li>
                @empty
                @endforelse
            </ul>
        </div>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <a href="{{url_query("translation-manager/$locale")}}"><i class="fa fa-arrow-circle-left"></i></a>&nbsp;{{$locale}}/{{$directory}}
                    </h3>
                </div>
                <div class="panel-body">
                    @foreach($folders as $folder)
		                <?php
		                $localeIndex = strpos($folder, "/$locale/");
		                $directory = substr($folder, $localeIndex);
		                $directory = str_replace("/$locale/", "", $directory);
		                $folderName = basename($folder);
		                ?>
                        <div class="col-md-1">
                            <a href="{{url_query("translation-manager/$locale", ['directory' => $directory])}}" class="text-center">
                                <img src="{{asset('images/folder.jpg')}}" alt="" class="img-thumbnail">
                                <p class="text-center">{{$folderName}}</p>
                            </a>
                        </div>
                    @endforeach
                    @foreach($files as $file)
		                <?php
		                $localeIndex = strpos($file, "/$locale/");
		                $directory = substr($file, $localeIndex);
		                $directory = str_replace("/$locale/", "", $directory);
		                $fileName = basename($file);
		                ?>
                        <div class="col-md-1">
                            <a href="{{url_query("translation-manager/$locale/edit", ['directory' => $directory])}}" class="text-center">
                                <img src="{{asset('images/file.png')}}" alt="" class="img-thumbnail">
                                <p class="text-center">{{$fileName}}</p>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection