# SimpleVC (Simple Video Converter)

## What is it? 

SimpleVC is a PHP audio and video converter

## Why?

The idea here is to provide a simple way to deal with multiple 
browser support for different audio and video formats. Unfortunately 
different web browsers, for different reasons, tend to support different 
audio and video formats. This means in order to ensure that your audio/video 
is accessible to everyone, you have to provide fall-back options, and 
then different browsers can display it in whatever format is friendly to 
them. It would be nice if you could just supply audio/video files in 
whatever format you have and not worry about whether it will play on 
Firefox or Chrome or whatever. That's what SimpleVC is all about. 
Just supply audio/video in whatever format you have and let SimpleVC 
create and render the fall-back options for you. 

## How? 

SimpleVC does it all through the awesome [FFmpeg] (https://ffmpeg.org/ffmpeg.html) library. 

## Requirements 

* PHP 5.4+ 
* FFmpeg (Version: N-71455-gfbdaebb)

## Quick guide 

The first thing you need to do is add SimpleVC as a dependency 
for your project. 

* Install with [Composer] (https://getcomposer.org): `composer require apefood/simplevc` 

Now you can use SimpleVC's methods and classes like: 

## Example 1: video conversion 

```PHP 

// file to convert
* $filename = /path/to/video/file/; 

// instantiate video object  
* $video = new Video($filename); 

// instantiate  video converter object 
* $video_converter = VideoConverter($video); 

// get the ffmpeg conversion command 
* $command = $video_converter->convert(); 

```

The convert() method returns the ffmpeg command as a string so that means ultimately 
it's up to you what you do with it. The conversion process is slow, so instead 
of running exec() on the command immediately, perhaps you might want to schedule 
that command as a job/task. 

```PHP 

// get html5 video's <source> tags for the video file & it's associated fall-back options. 
$html = new HtmlFactory($video_converter); 
$source = $html->render(); 

```

Now since the exec() command will be deferred and not run immediately, that means the 
$source variable points to at least 2 non-existent files at the moment. So perhaps you can 
also defer publishing the video on a web page until the conversion task has completed. 

## Example 2: audio conversion 

There is no example 2 because it's pretty much the same as example 1, but with an audio file. 
Basically swap out every instance of 'video' with 'audio' and you are good to go. 

##WARNING! 

# NO 3GPs ALLOWED! 

When I tried converting a 3GP file to MP4 it failed, on multiple attempts. So do not use this 
package with 3GP files. In fact, I advise you to stick to popular media formats (i.e. MP3/4, MKV, WAV etc.) 
just to be on the safe side. It's 2016, why would you have 3GP files anyway? 

## Closing. 

Do you like this package? Do you hate it? Is there something I'm not doing right (of course there is)? 
Got a suggestion? Quickest way to find me is via [twitter] (https://twitter.com/LordKabelo). This is my 
first PHP package, so I welcome pull requests and see them as a learning opportunity more than anything else. 
To paraphrase the great Gavin Belson; Together, we can make the world a better place. 






 

