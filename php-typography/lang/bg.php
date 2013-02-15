<?php
/*
	Project: PHP Typography
	Project URI: http://kingdesk.com/projects/php-typography/
	
	
	File modified to place pattern and exceptions in arrays that can be understood in php files.
	This file is released under the same copyright as the below referenced original file
	Original unmodified file is available at: http://mirror.unl.edu/ctan/language/hyph-utf8/tex/generic/hyph-utf8/patterns/
	Original file name: hyph-bg.tex
	
//============================================================================================================
	ORIGINAL FILE INFO

		% Bulgarian hyphenation patterns, version 1.7, July 2008
		%   Copyright 1994-2008 Georgi Boshnakov
		%   Georgi dot Boshnakov at manchester dot ac dot uk
		% 
		% This file can be redistributed and/or modified under the terms
		% of the LaTeX Project Public License distributed from CTAN
		% archives in directory macros/latex/base/lppl.txt; either
		% version 1 of the License, or any later version.
		%
		%
		%   First version:  1994
		%   Modified:  June 2000 (minor changes)
		%   Modified:  May  2006 (added copyright notice)
		%   Modified:  June 2008 (changed encoding to utf-8)
		%
		%   Please send wrongly hyphenated words and suggestions for
		%   corrections to the address given towards the beginning of this
		%   file.
		%
		%
		% Note: The original name of this file was 'bghyphsi.tex' which is
		%   part of the package 'bghyphen'. The package 'bghyphen' is now
		%   obsolete but it is still available on CTAN and currently (June 2008)
		%   gives the same hyphenation results.
		%   
		%
		%
		% To make TeX use these patterns:
		%
		%    (1) Make sure that the hyph-utf8 package is present in your TeX
		%        system.
		%
		%    (2) generate the necessary formats (TeX, LaTeX, pdfLaTeX, etc),
		%        instructing TeX to load 'loadhyph-bg.tex' for Bulgarian
		%        hyphenation.
		%
		% The LaTeX babel package sets \lefthyphenmin and \righthyphenmin to 2
		%   when the language is switched to Bulgarian.  Developers who write
		%   support for Bulgarian outside LaTeX and/or babel need to take care
		%   of this.

//============================================================================================================	
	
*/

$patgenLanguage = 'Bulgarian';

$patgenExceptions = array();

$patgenMaxSeg = 3;

$patgen = array(
'begin'=>array(
'дзв'=>'0040',
'джр'=>'0040',
'джл'=>'0040',
'вгл'=>'0040',
'вдл'=>'0040',
'вгр'=>'0040',
'вгн'=>'0040',
'впл'=>'0040',
'вкл'=>'0040',
'вкр'=>'0040',
'втр'=>'0040',
'сгл'=>'0040',
'здр'=>'0040',
'сгр'=>'0040',
'сбр'=>'0040',
'сдр'=>'0040',
'ждр'=>'0040',
'скл'=>'0040',
'спл'=>'0040',
'спр'=>'0040',
'стр'=>'0040',
'скр'=>'0040',
'шпр'=>'0040',
'скв'=>'0040',
'взр'=>'0040',
'всл'=>'0040',
'всм'=>'0040',
'вср'=>'0040',
'свр'=>'0040',
'схл'=>'0040',
'схр'=>'0040',
'хвр'=>'0040',
'вст'=>'0040',
'схв'=>'0040',
'смр'=>'0040'
),
'end'=>array(
'нкт'=>'0400',
'нкс'=>'0400',
'кст'=>'0400'
),
'all'=>array(
'а'=>'11',
'б'=>'11',
'в'=>'11',
'г'=>'11',
'д'=>'11',
'е'=>'11',
'ж'=>'11',
'з'=>'11',
'и'=>'11',
'й'=>'11',
'к'=>'11',
'л'=>'11',
'м'=>'11',
'н'=>'11',
'о'=>'11',
'п'=>'11',
'р'=>'11',
'с'=>'11',
'т'=>'11',
'у'=>'11',
'ф'=>'11',
'х'=>'11',
'ц'=>'11',
'ч'=>'11',
'ш'=>'11',
'щ'=>'11',
'ъ'=>'11',
'ь'=>'00',
'ю'=>'11',
'я'=>'11',
'ба'=>'040',
'бе'=>'040',
'би'=>'040',
'бо'=>'040',
'бу'=>'040',
'бъ'=>'040',
'бю'=>'040',
'бя'=>'040',
'ва'=>'040',
'ве'=>'040',
'ви'=>'040',
'во'=>'040',
'ву'=>'040',
'въ'=>'040',
'вю'=>'040',
'вя'=>'040',
'га'=>'040',
'ге'=>'040',
'ги'=>'040',
'го'=>'040',
'гу'=>'040',
'гъ'=>'040',
'гю'=>'040',
'гя'=>'040',
'да'=>'040',
'де'=>'040',
'ди'=>'040',
'до'=>'040',
'ду'=>'040',
'дъ'=>'040',
'дю'=>'040',
'дя'=>'040',
'жа'=>'040',
'же'=>'040',
'жи'=>'040',
'жо'=>'040',
'жу'=>'040',
'жъ'=>'040',
'жю'=>'040',
'жя'=>'040',
'за'=>'040',
'зе'=>'040',
'зи'=>'040',
'зо'=>'040',
'зу'=>'040',
'зъ'=>'040',
'зю'=>'040',
'зя'=>'040',
'йа'=>'040',
'йе'=>'040',
'йи'=>'040',
'йо'=>'040',
'йу'=>'040',
'йъ'=>'040',
'йю'=>'040',
'йя'=>'040',
'ка'=>'040',
'ке'=>'040',
'ки'=>'040',
'ко'=>'040',
'ку'=>'040',
'къ'=>'040',
'кю'=>'040',
'кя'=>'040',
'ла'=>'040',
'ле'=>'040',
'ли'=>'040',
'ло'=>'040',
'лу'=>'040',
'лъ'=>'040',
'лю'=>'040',
'ля'=>'040',
'ма'=>'040',
'ме'=>'040',
'ми'=>'040',
'мо'=>'040',
'му'=>'040',
'мъ'=>'040',
'мю'=>'040',
'мя'=>'040',
'на'=>'040',
'не'=>'040',
'ни'=>'040',
'но'=>'040',
'ну'=>'040',
'нъ'=>'040',
'ню'=>'040',
'ня'=>'040',
'па'=>'040',
'пе'=>'040',
'пи'=>'040',
'по'=>'040',
'пу'=>'040',
'пъ'=>'040',
'пю'=>'040',
'пя'=>'040',
'ра'=>'040',
'ре'=>'040',
'ри'=>'040',
'ро'=>'040',
'ру'=>'040',
'ръ'=>'040',
'рю'=>'040',
'ря'=>'040',
'са'=>'040',
'се'=>'040',
'си'=>'040',
'со'=>'040',
'су'=>'040',
'съ'=>'040',
'сю'=>'040',
'ся'=>'040',
'та'=>'040',
'те'=>'040',
'ти'=>'040',
'то'=>'040',
'ту'=>'040',
'тъ'=>'040',
'тю'=>'040',
'тя'=>'040',
'фа'=>'040',
'фе'=>'040',
'фи'=>'040',
'фо'=>'040',
'фу'=>'040',
'фъ'=>'040',
'фю'=>'040',
'фя'=>'040',
'ха'=>'040',
'хе'=>'040',
'хи'=>'040',
'хо'=>'040',
'ху'=>'040',
'хъ'=>'040',
'хю'=>'040',
'хя'=>'040',
'ца'=>'040',
'це'=>'040',
'ци'=>'040',
'цо'=>'040',
'цу'=>'040',
'цъ'=>'040',
'цю'=>'040',
'ця'=>'040',
'ча'=>'040',
'че'=>'040',
'чи'=>'040',
'чо'=>'040',
'чу'=>'040',
'чъ'=>'040',
'чю'=>'040',
'чя'=>'040',
'ша'=>'040',
'ше'=>'040',
'ши'=>'040',
'шо'=>'040',
'шу'=>'040',
'шъ'=>'040',
'шю'=>'040',
'шя'=>'040',
'ща'=>'040',
'ще'=>'040',
'щи'=>'040',
'що'=>'040',
'щу'=>'040',
'щъ'=>'040',
'щю'=>'040',
'щя'=>'040',
'ьа'=>'040',
'ье'=>'040',
'ьи'=>'040',
'ьо'=>'040',
'ьу'=>'040',
'ьъ'=>'040',
'ью'=>'040',
'ья'=>'040',
'бб'=>'434',
'бв'=>'232',
'бг'=>'232',
'бд'=>'232',
'бж'=>'232',
'бз'=>'232',
'бй'=>'232',
'бк'=>'232',
'бл'=>'232',
'бм'=>'232',
'бн'=>'232',
'бп'=>'232',
'бр'=>'232',
'бс'=>'232',
'бт'=>'232',
'бф'=>'232',
'бх'=>'232',
'бц'=>'232',
'бч'=>'232',
'бш'=>'232',
'бщ'=>'232',
'вб'=>'232',
'вв'=>'434',
'вг'=>'232',
'вд'=>'232',
'вж'=>'232',
'вз'=>'232',
'вй'=>'232',
'вк'=>'232',
'вл'=>'232',
'вм'=>'232',
'вн'=>'232',
'вп'=>'232',
'вр'=>'232',
'вс'=>'232',
'вт'=>'232',
'вф'=>'232',
'вх'=>'232',
'вц'=>'232',
'вч'=>'232',
'вш'=>'232',
'вщ'=>'232',
'гб'=>'232',
'гв'=>'232',
'гг'=>'434',
'гд'=>'232',
'гж'=>'232',
'гз'=>'232',
'гй'=>'232',
'гк'=>'232',
'гл'=>'232',
'гм'=>'232',
'гн'=>'232',
'гп'=>'232',
'гр'=>'232',
'гс'=>'232',
'гт'=>'232',
'гф'=>'232',
'гх'=>'232',
'гц'=>'232',
'гч'=>'232',
'гш'=>'232',
'гщ'=>'232',
'дб'=>'232',
'дв'=>'232',
'дг'=>'232',
'дд'=>'434',
'дж'=>'340',
'дз'=>'232',
'дй'=>'232',
'дк'=>'232',
'дл'=>'232',
'дм'=>'232',
'дн'=>'232',
'дп'=>'232',
'др'=>'232',
'дс'=>'232',
'дт'=>'232',
'дф'=>'232',
'дх'=>'232',
'дц'=>'232',
'дч'=>'232',
'дш'=>'232',
'дщ'=>'232',
'жб'=>'232',
'жв'=>'232',
'жг'=>'232',
'жд'=>'232',
'жж'=>'434',
'жз'=>'232',
'жй'=>'232',
'жк'=>'232',
'жл'=>'232',
'жм'=>'232',
'жн'=>'232',
'жп'=>'232',
'жр'=>'232',
'жс'=>'232',
'жт'=>'232',
'жф'=>'232',
'жх'=>'232',
'жц'=>'232',
'жч'=>'232',
'жш'=>'232',
'жщ'=>'232',
'зб'=>'232',
'зв'=>'232',
'зг'=>'232',
'зд'=>'232',
'зж'=>'232',
'зз'=>'434',
'зй'=>'232',
'зк'=>'232',
'зл'=>'232',
'зм'=>'232',
'зн'=>'232',
'зп'=>'232',
'зр'=>'232',
'зс'=>'232',
'зт'=>'232',
'зф'=>'232',
'зх'=>'232',
'зц'=>'232',
'зч'=>'232',
'зш'=>'232',
'зщ'=>'232',
'йб'=>'232',
'йв'=>'232',
'йг'=>'232',
'йд'=>'232',
'йж'=>'232',
'йз'=>'232',
'йй'=>'434',
'йк'=>'232',
'йл'=>'232',
'йм'=>'232',
'йн'=>'232',
'йп'=>'232',
'йр'=>'232',
'йс'=>'232',
'йт'=>'232',
'йф'=>'232',
'йх'=>'232',
'йц'=>'232',
'йч'=>'232',
'йш'=>'232',
'йщ'=>'232',
'кб'=>'232',
'кв'=>'232',
'кг'=>'232',
'кд'=>'232',
'кж'=>'232',
'кз'=>'232',
'кй'=>'232',
'кк'=>'434',
'кл'=>'232',
'км'=>'232',
'кн'=>'232',
'кп'=>'232',
'кр'=>'232',
'кс'=>'232',
'кт'=>'232',
'кф'=>'232',
'кх'=>'232',
'кц'=>'232',
'кч'=>'232',
'кш'=>'232',
'кщ'=>'232',
'лб'=>'232',
'лв'=>'232',
'лг'=>'232',
'лд'=>'232',
'лж'=>'232',
'лз'=>'232',
'лй'=>'232',
'лк'=>'232',
'лл'=>'434',
'лм'=>'232',
'лн'=>'232',
'лп'=>'232',
'лр'=>'232',
'лс'=>'232',
'лт'=>'232',
'лф'=>'232',
'лх'=>'232',
'лц'=>'232',
'лч'=>'232',
'лш'=>'232',
'лщ'=>'232',
'мб'=>'232',
'мв'=>'232',
'мг'=>'232',
'мд'=>'232',
'мж'=>'232',
'мз'=>'232',
'мй'=>'232',
'мк'=>'232',
'мл'=>'232',
'мм'=>'434',
'мн'=>'232',
'мп'=>'232',
'мр'=>'232',
'мс'=>'232',
'мт'=>'232',
'мф'=>'232',
'мх'=>'232',
'мц'=>'232',
'мч'=>'232',
'мш'=>'232',
'мщ'=>'232',
'нб'=>'232',
'нв'=>'232',
'нг'=>'232',
'нд'=>'232',
'нж'=>'232',
'нз'=>'232',
'нй'=>'232',
'нк'=>'232',
'нл'=>'232',
'нм'=>'232',
'нн'=>'434',
'нп'=>'232',
'нр'=>'232',
'нс'=>'232',
'нт'=>'232',
'нф'=>'232',
'нх'=>'232',
'нц'=>'232',
'нч'=>'232',
'нш'=>'232',
'нщ'=>'232',
'пб'=>'232',
'пв'=>'232',
'пг'=>'232',
'пд'=>'232',
'пж'=>'232',
'пз'=>'232',
'пй'=>'232',
'пк'=>'232',
'пл'=>'232',
'пм'=>'232',
'пн'=>'232',
'пп'=>'434',
'пр'=>'232',
'пс'=>'232',
'пт'=>'232',
'пф'=>'232',
'пх'=>'232',
'пц'=>'232',
'пч'=>'232',
'пш'=>'232',
'пщ'=>'232',
'рб'=>'232',
'рв'=>'232',
'рг'=>'232',
'рд'=>'232',
'рж'=>'232',
'рз'=>'232',
'рй'=>'232',
'рк'=>'232',
'рл'=>'232',
'рм'=>'232',
'рн'=>'232',
'рп'=>'232',
'рр'=>'434',
'рс'=>'232',
'рт'=>'232',
'рф'=>'232',
'рх'=>'232',
'рц'=>'232',
'рч'=>'232',
'рш'=>'232',
'рщ'=>'232',
'сб'=>'232',
'св'=>'232',
'сг'=>'232',
'сд'=>'232',
'сж'=>'232',
'сз'=>'232',
'сй'=>'232',
'ск'=>'232',
'сл'=>'232',
'см'=>'232',
'сн'=>'232',
'сп'=>'232',
'ср'=>'232',
'сс'=>'434',
'ст'=>'232',
'сф'=>'232',
'сх'=>'232',
'сц'=>'232',
'сч'=>'232',
'сш'=>'232',
'сщ'=>'232',
'тб'=>'232',
'тв'=>'232',
'тг'=>'232',
'тд'=>'232',
'тж'=>'232',
'тз'=>'232',
'тй'=>'232',
'тк'=>'232',
'тл'=>'232',
'тм'=>'232',
'тн'=>'232',
'тп'=>'232',
'тр'=>'232',
'тс'=>'232',
'тт'=>'434',
'тф'=>'232',
'тх'=>'232',
'тц'=>'232',
'тч'=>'232',
'тш'=>'232',
'тщ'=>'232',
'фб'=>'232',
'фв'=>'232',
'фг'=>'232',
'фд'=>'232',
'фж'=>'232',
'фз'=>'232',
'фй'=>'232',
'фк'=>'232',
'фл'=>'232',
'фм'=>'232',
'фн'=>'232',
'фп'=>'232',
'фр'=>'232',
'фс'=>'232',
'фт'=>'232',
'фф'=>'434',
'фх'=>'232',
'фц'=>'232',
'фч'=>'232',
'фш'=>'232',
'фщ'=>'232',
'хб'=>'232',
'хв'=>'232',
'хг'=>'232',
'хд'=>'232',
'хж'=>'232',
'хз'=>'232',
'хй'=>'232',
'хк'=>'232',
'хл'=>'232',
'хм'=>'232',
'хн'=>'232',
'хп'=>'232',
'хр'=>'232',
'хс'=>'232',
'хт'=>'232',
'хф'=>'232',
'хх'=>'434',
'хц'=>'232',
'хч'=>'232',
'хш'=>'232',
'хщ'=>'232',
'цб'=>'232',
'цв'=>'232',
'цг'=>'232',
'цд'=>'232',
'цж'=>'232',
'цз'=>'232',
'цй'=>'232',
'цк'=>'232',
'цл'=>'232',
'цм'=>'232',
'цн'=>'232',
'цп'=>'232',
'цр'=>'232',
'цс'=>'232',
'цт'=>'232',
'цф'=>'232',
'цх'=>'232',
'цц'=>'434',
'цч'=>'232',
'цш'=>'232',
'цщ'=>'232',
'чб'=>'232',
'чв'=>'232',
'чг'=>'232',
'чд'=>'232',
'чж'=>'232',
'чз'=>'232',
'чй'=>'232',
'чк'=>'232',
'чл'=>'232',
'чм'=>'232',
'чн'=>'232',
'чп'=>'232',
'чр'=>'232',
'чс'=>'232',
'чт'=>'232',
'чф'=>'232',
'чх'=>'232',
'чц'=>'232',
'чч'=>'434',
'чш'=>'232',
'чщ'=>'232',
'шб'=>'232',
'шв'=>'232',
'шг'=>'232',
'шд'=>'232',
'шж'=>'232',
'шз'=>'232',
'шй'=>'232',
'шк'=>'232',
'шл'=>'232',
'шм'=>'232',
'шн'=>'232',
'шп'=>'232',
'шр'=>'232',
'шс'=>'232',
'шт'=>'232',
'шф'=>'232',
'шх'=>'232',
'шц'=>'232',
'шч'=>'232',
'шш'=>'434',
'шщ'=>'232',
'щб'=>'232',
'щв'=>'232',
'щг'=>'232',
'щд'=>'232',
'щж'=>'232',
'щз'=>'232',
'щй'=>'232',
'щк'=>'232',
'щл'=>'232',
'щм'=>'232',
'щн'=>'232',
'щп'=>'232',
'щр'=>'232',
'щс'=>'232',
'щт'=>'232',
'щф'=>'232',
'щх'=>'232',
'щц'=>'232',
'щч'=>'232',
'щш'=>'232',
'щщ'=>'434',
'ааа'=>'0004',
'аае'=>'0004',
'ааи'=>'0004',
'аао'=>'0004',
'аау'=>'0004',
'ааъ'=>'0004',
'ааю'=>'0004',
'аая'=>'0004',
'аеа'=>'0004',
'аее'=>'0004',
'аеи'=>'0004',
'аео'=>'0004',
'аеу'=>'0004',
'аеъ'=>'0004',
'аею'=>'0004',
'аея'=>'0004',
'аиа'=>'0004',
'аие'=>'0004',
'аии'=>'0004',
'аио'=>'0004',
'аиу'=>'0004',
'аиъ'=>'0004',
'аию'=>'0004',
'аия'=>'0004',
'аоа'=>'0004',
'аое'=>'0004',
'аои'=>'0004',
'аоо'=>'0004',
'аоу'=>'0004',
'аоъ'=>'0004',
'аою'=>'0004',
'аоя'=>'0004',
'ауа'=>'0004',
'ауе'=>'0004',
'ауи'=>'0004',
'ауо'=>'0004',
'ауу'=>'0004',
'ауъ'=>'0004',
'аую'=>'0004',
'ауя'=>'0004',
'аъа'=>'0004',
'аъе'=>'0004',
'аъи'=>'0004',
'аъо'=>'0004',
'аъу'=>'0004',
'аъъ'=>'0004',
'аъю'=>'0004',
'аъя'=>'0004',
'аюа'=>'0004',
'аюе'=>'0004',
'аюи'=>'0004',
'аюо'=>'0004',
'аюу'=>'0004',
'аюъ'=>'0004',
'аюю'=>'0004',
'аюя'=>'0004',
'аяа'=>'0004',
'аяе'=>'0004',
'аяи'=>'0004',
'аяо'=>'0004',
'аяу'=>'0004',
'аяъ'=>'0004',
'аяю'=>'0004',
'аяя'=>'0004',
'еаа'=>'0004',
'еае'=>'0004',
'еаи'=>'0004',
'еао'=>'0004',
'еау'=>'0004',
'еаъ'=>'0004',
'еаю'=>'0004',
'еая'=>'0004',
'ееа'=>'0004',
'еее'=>'0004',
'ееи'=>'0004',
'еео'=>'0004',
'ееу'=>'0004',
'ееъ'=>'0004',
'еею'=>'0004',
'еея'=>'0004',
'еиа'=>'0004',
'еие'=>'0004',
'еии'=>'0004',
'еио'=>'0004',
'еиу'=>'0004',
'еиъ'=>'0004',
'еию'=>'0004',
'еия'=>'0004',
'еоа'=>'0004',
'еое'=>'0004',
'еои'=>'0004',
'еоо'=>'0004',
'еоу'=>'0004',
'еоъ'=>'0004',
'еою'=>'0004',
'еоя'=>'0004',
'еуа'=>'0004',
'еуе'=>'0004',
'еуи'=>'0004',
'еуо'=>'0004',
'еуу'=>'0004',
'еуъ'=>'0004',
'еую'=>'0004',
'еуя'=>'0004',
'еъа'=>'0004',
'еъе'=>'0004',
'еъи'=>'0004',
'еъо'=>'0004',
'еъу'=>'0004',
'еъъ'=>'0004',
'еъю'=>'0004',
'еъя'=>'0004',
'еюа'=>'0004',
'еюе'=>'0004',
'еюи'=>'0004',
'еюо'=>'0004',
'еюу'=>'0004',
'еюъ'=>'0004',
'еюю'=>'0004',
'еюя'=>'0004',
'еяа'=>'0004',
'еяе'=>'0004',
'еяи'=>'0004',
'еяо'=>'0004',
'еяу'=>'0004',
'еяъ'=>'0004',
'еяю'=>'0004',
'еяя'=>'0004',
'иаа'=>'0004',
'иае'=>'0004',
'иаи'=>'0004',
'иао'=>'0004',
'иау'=>'0004',
'иаъ'=>'0004',
'иаю'=>'0004',
'иая'=>'0004',
'иеа'=>'0004',
'иее'=>'0004',
'иеи'=>'0004',
'иео'=>'0004',
'иеу'=>'0004',
'иеъ'=>'0004',
'иею'=>'0004',
'иея'=>'0004',
'ииа'=>'0004',
'иие'=>'0004',
'иии'=>'0004',
'иио'=>'0004',
'ииу'=>'0004',
'ииъ'=>'0004',
'иию'=>'0004',
'иия'=>'0004',
'иоа'=>'0004',
'иое'=>'0004',
'иои'=>'0004',
'иоо'=>'0004',
'иоу'=>'0004',
'иоъ'=>'0004',
'иою'=>'0004',
'иоя'=>'0004',
'иуа'=>'0004',
'иуе'=>'0004',
'иуи'=>'0004',
'иуо'=>'0004',
'иуу'=>'0004',
'иуъ'=>'0004',
'иую'=>'0004',
'иуя'=>'0004',
'иъа'=>'0004',
'иъе'=>'0004',
'иъи'=>'0004',
'иъо'=>'0004',
'иъу'=>'0004',
'иъъ'=>'0004',
'иъю'=>'0004',
'иъя'=>'0004',
'июа'=>'0004',
'июе'=>'0004',
'июи'=>'0004',
'июо'=>'0004',
'июу'=>'0004',
'июъ'=>'0004',
'июю'=>'0004',
'июя'=>'0004',
'ияа'=>'0004',
'ияе'=>'0004',
'ияи'=>'0004',
'ияо'=>'0004',
'ияу'=>'0004',
'ияъ'=>'0004',
'ияю'=>'0004',
'ияя'=>'0004',
'оаа'=>'0004',
'оае'=>'0004',
'оаи'=>'0004',
'оао'=>'0004',
'оау'=>'0004',
'оаъ'=>'0004',
'оаю'=>'0004',
'оая'=>'0004',
'оеа'=>'0004',
'оее'=>'0004',
'оеи'=>'0004',
'оео'=>'0004',
'оеу'=>'0004',
'оеъ'=>'0004',
'оею'=>'0004',
'оея'=>'0004',
'оиа'=>'0004',
'оие'=>'0004',
'оии'=>'0004',
'оио'=>'0004',
'оиу'=>'0004',
'оиъ'=>'0004',
'оию'=>'0004',
'оия'=>'0004',
'ооа'=>'0004',
'оое'=>'0004',
'оои'=>'0004',
'ооо'=>'0004',
'ооу'=>'0004',
'ооъ'=>'0004',
'оою'=>'0004',
'ооя'=>'0004',
'оуа'=>'0004',
'оуе'=>'0004',
'оуи'=>'0004',
'оуо'=>'0004',
'оуу'=>'0004',
'оуъ'=>'0004',
'оую'=>'0004',
'оуя'=>'0004',
'оъа'=>'0004',
'оъе'=>'0004',
'оъи'=>'0004',
'оъо'=>'0004',
'оъу'=>'0004',
'оъъ'=>'0004',
'оъю'=>'0004',
'оъя'=>'0004',
'оюа'=>'0004',
'оюе'=>'0004',
'оюи'=>'0004',
'оюо'=>'0004',
'оюу'=>'0004',
'оюъ'=>'0004',
'оюю'=>'0004',
'оюя'=>'0004',
'ояа'=>'0004',
'ояе'=>'0004',
'ояи'=>'0004',
'ояо'=>'0004',
'ояу'=>'0004',
'ояъ'=>'0004',
'ояю'=>'0004',
'ояя'=>'0004',
'уаа'=>'0004',
'уае'=>'0004',
'уаи'=>'0004',
'уао'=>'0004',
'уау'=>'0004',
'уаъ'=>'0004',
'уаю'=>'0004',
'уая'=>'0004',
'уеа'=>'0004',
'уее'=>'0004',
'уеи'=>'0004',
'уео'=>'0004',
'уеу'=>'0004',
'уеъ'=>'0004',
'уею'=>'0004',
'уея'=>'0004',
'уиа'=>'0004',
'уие'=>'0004',
'уии'=>'0004',
'уио'=>'0004',
'уиу'=>'0004',
'уиъ'=>'0004',
'уию'=>'0004',
'уия'=>'0004',
'уоа'=>'0004',
'уое'=>'0004',
'уои'=>'0004',
'уоо'=>'0004',
'уоу'=>'0004',
'уоъ'=>'0004',
'уою'=>'0004',
'уоя'=>'0004',
'ууа'=>'0004',
'ууе'=>'0004',
'ууи'=>'0004',
'ууо'=>'0004',
'ууу'=>'0004',
'ууъ'=>'0004',
'уую'=>'0004',
'ууя'=>'0004',
'уъа'=>'0004',
'уъе'=>'0004',
'уъи'=>'0004',
'уъо'=>'0004',
'уъу'=>'0004',
'уъъ'=>'0004',
'уъю'=>'0004',
'уъя'=>'0004',
'уюа'=>'0004',
'уюе'=>'0004',
'уюи'=>'0004',
'уюо'=>'0004',
'уюу'=>'0004',
'уюъ'=>'0004',
'уюю'=>'0004',
'уюя'=>'0004',
'уяа'=>'0004',
'уяе'=>'0004',
'уяи'=>'0004',
'уяо'=>'0004',
'уяу'=>'0004',
'уяъ'=>'0004',
'уяю'=>'0004',
'уяя'=>'0004',
'ъаа'=>'0004',
'ъае'=>'0004',
'ъаи'=>'0004',
'ъао'=>'0004',
'ъау'=>'0004',
'ъаъ'=>'0004',
'ъаю'=>'0004',
'ъая'=>'0004',
'ъеа'=>'0004',
'ъее'=>'0004',
'ъеи'=>'0004',
'ъео'=>'0004',
'ъеу'=>'0004',
'ъеъ'=>'0004',
'ъею'=>'0004',
'ъея'=>'0004',
'ъиа'=>'0004',
'ъие'=>'0004',
'ъии'=>'0004',
'ъио'=>'0004',
'ъиу'=>'0004',
'ъиъ'=>'0004',
'ъию'=>'0004',
'ъия'=>'0004',
'ъоа'=>'0004',
'ъое'=>'0004',
'ъои'=>'0004',
'ъоо'=>'0004',
'ъоу'=>'0004',
'ъоъ'=>'0004',
'ъою'=>'0004',
'ъоя'=>'0004',
'ъуа'=>'0004',
'ъуе'=>'0004',
'ъуи'=>'0004',
'ъуо'=>'0004',
'ъуу'=>'0004',
'ъуъ'=>'0004',
'ъую'=>'0004',
'ъуя'=>'0004',
'ъъа'=>'0004',
'ъъе'=>'0004',
'ъъи'=>'0004',
'ъъо'=>'0004',
'ъъу'=>'0004',
'ъъъ'=>'0004',
'ъъю'=>'0004',
'ъъя'=>'0004',
'ъюа'=>'0004',
'ъюе'=>'0004',
'ъюи'=>'0004',
'ъюо'=>'0004',
'ъюу'=>'0004',
'ъюъ'=>'0004',
'ъюю'=>'0004',
'ъюя'=>'0004',
'ъяа'=>'0004',
'ъяе'=>'0004',
'ъяи'=>'0004',
'ъяо'=>'0004',
'ъяу'=>'0004',
'ъяъ'=>'0004',
'ъяю'=>'0004',
'ъяя'=>'0004',
'юаа'=>'0004',
'юае'=>'0004',
'юаи'=>'0004',
'юао'=>'0004',
'юау'=>'0004',
'юаъ'=>'0004',
'юаю'=>'0004',
'юая'=>'0004',
'юеа'=>'0004',
'юее'=>'0004',
'юеи'=>'0004',
'юео'=>'0004',
'юеу'=>'0004',
'юеъ'=>'0004',
'юею'=>'0004',
'юея'=>'0004',
'юиа'=>'0004',
'юие'=>'0004',
'юии'=>'0004',
'юио'=>'0004',
'юиу'=>'0004',
'юиъ'=>'0004',
'юию'=>'0004',
'юия'=>'0004',
'юоа'=>'0004',
'юое'=>'0004',
'юои'=>'0004',
'юоо'=>'0004',
'юоу'=>'0004',
'юоъ'=>'0004',
'юою'=>'0004',
'юоя'=>'0004',
'юуа'=>'0004',
'юуе'=>'0004',
'юуи'=>'0004',
'юуо'=>'0004',
'юуу'=>'0004',
'юуъ'=>'0004',
'юую'=>'0004',
'юуя'=>'0004',
'юъа'=>'0004',
'юъе'=>'0004',
'юъи'=>'0004',
'юъо'=>'0004',
'юъу'=>'0004',
'юъъ'=>'0004',
'юъю'=>'0004',
'юъя'=>'0004',
'ююа'=>'0004',
'ююе'=>'0004',
'ююи'=>'0004',
'ююо'=>'0004',
'ююу'=>'0004',
'ююъ'=>'0004',
'ююю'=>'0004',
'ююя'=>'0004',
'юяа'=>'0004',
'юяе'=>'0004',
'юяи'=>'0004',
'юяо'=>'0004',
'юяу'=>'0004',
'юяъ'=>'0004',
'юяю'=>'0004',
'юяя'=>'0004',
'яаа'=>'0004',
'яае'=>'0004',
'яаи'=>'0004',
'яао'=>'0004',
'яау'=>'0004',
'яаъ'=>'0004',
'яаю'=>'0004',
'яая'=>'0004',
'яеа'=>'0004',
'яее'=>'0004',
'яеи'=>'0004',
'яео'=>'0004',
'яеу'=>'0004',
'яеъ'=>'0004',
'яею'=>'0004',
'яея'=>'0004',
'яиа'=>'0004',
'яие'=>'0004',
'яии'=>'0004',
'яио'=>'0004',
'яиу'=>'0004',
'яиъ'=>'0004',
'яию'=>'0004',
'яия'=>'0004',
'яоа'=>'0004',
'яое'=>'0004',
'яои'=>'0004',
'яоо'=>'0004',
'яоу'=>'0004',
'яоъ'=>'0004',
'яою'=>'0004',
'яоя'=>'0004',
'яуа'=>'0004',
'яуе'=>'0004',
'яуи'=>'0004',
'яуо'=>'0004',
'яуу'=>'0004',
'яуъ'=>'0004',
'яую'=>'0004',
'яуя'=>'0004',
'яъа'=>'0004',
'яъе'=>'0004',
'яъи'=>'0004',
'яъо'=>'0004',
'яъу'=>'0004',
'яъъ'=>'0004',
'яъю'=>'0004',
'яъя'=>'0004',
'яюа'=>'0004',
'яюе'=>'0004',
'яюи'=>'0004',
'яюо'=>'0004',
'яюу'=>'0004',
'яюъ'=>'0004',
'яюю'=>'0004',
'яюя'=>'0004',
'яяа'=>'0004',
'яяе'=>'0004',
'яяи'=>'0004',
'яяо'=>'0004',
'яяу'=>'0004',
'яяъ'=>'0004',
'яяю'=>'0004',
'яяя'=>'0004',
'йбб'=>'0400',
'йбв'=>'0400',
'йбг'=>'0400',
'йбд'=>'0400',
'йбж'=>'0400',
'йбз'=>'0400',
'йбй'=>'0400',
'йбк'=>'0400',
'йбл'=>'0400',
'йбм'=>'0400',
'йбн'=>'0400',
'йбп'=>'0400',
'йбр'=>'0400',
'йбс'=>'0400',
'йбт'=>'0400',
'йбф'=>'0400',
'йбх'=>'0400',
'йбц'=>'0400',
'йбч'=>'0400',
'йбш'=>'0400',
'йбщ'=>'0400',
'йвб'=>'0400',
'йвв'=>'0400',
'йвг'=>'0400',
'йвд'=>'0400',
'йвж'=>'0400',
'йвз'=>'0400',
'йвй'=>'0400',
'йвк'=>'0400',
'йвл'=>'0400',
'йвм'=>'0400',
'йвн'=>'0400',
'йвп'=>'0400',
'йвр'=>'0400',
'йвс'=>'0400',
'йвт'=>'0400',
'йвф'=>'0400',
'йвх'=>'0400',
'йвц'=>'0400',
'йвч'=>'0400',
'йвш'=>'0400',
'йвщ'=>'0400',
'йгб'=>'0400',
'йгв'=>'0400',
'йгг'=>'0400',
'йгд'=>'0400',
'йгж'=>'0400',
'йгз'=>'0400',
'йгй'=>'0400',
'йгк'=>'0400',
'йгл'=>'0400',
'йгм'=>'0400',
'йгн'=>'0400',
'йгп'=>'0400',
'йгр'=>'0400',
'йгс'=>'0400',
'йгт'=>'0400',
'йгф'=>'0400',
'йгх'=>'0400',
'йгц'=>'0400',
'йгч'=>'0400',
'йгш'=>'0400',
'йгщ'=>'0400',
'йдб'=>'0400',
'йдв'=>'0400',
'йдг'=>'0400',
'йдд'=>'0400',
'йдж'=>'0400',
'йдз'=>'0400',
'йдй'=>'0400',
'йдк'=>'0400',
'йдл'=>'0400',
'йдм'=>'0400',
'йдн'=>'0400',
'йдп'=>'0400',
'йдр'=>'0400',
'йдс'=>'0400',
'йдт'=>'0400',
'йдф'=>'0400',
'йдх'=>'0400',
'йдц'=>'0400',
'йдч'=>'0400',
'йдш'=>'0400',
'йдщ'=>'0400',
'йжб'=>'0400',
'йжв'=>'0400',
'йжг'=>'0400',
'йжд'=>'0400',
'йжж'=>'0400',
'йжз'=>'0400',
'йжй'=>'0400',
'йжк'=>'0400',
'йжл'=>'0400',
'йжм'=>'0400',
'йжн'=>'0400',
'йжп'=>'0400',
'йжр'=>'0400',
'йжс'=>'0400',
'йжт'=>'0400',
'йжф'=>'0400',
'йжх'=>'0400',
'йжц'=>'0400',
'йжч'=>'0400',
'йжш'=>'0400',
'йжщ'=>'0400',
'йзб'=>'0400',
'йзв'=>'0400',
'йзг'=>'0400',
'йзд'=>'0400',
'йзж'=>'0400',
'йзз'=>'0400',
'йзй'=>'0400',
'йзк'=>'0400',
'йзл'=>'0400',
'йзм'=>'0400',
'йзн'=>'0400',
'йзп'=>'0400',
'йзр'=>'0400',
'йзс'=>'0400',
'йзт'=>'0400',
'йзф'=>'0400',
'йзх'=>'0400',
'йзц'=>'0400',
'йзч'=>'0400',
'йзш'=>'0400',
'йзщ'=>'0400',
'ййб'=>'0400',
'ййв'=>'0400',
'ййг'=>'0400',
'ййд'=>'0400',
'ййж'=>'0400',
'ййз'=>'0400',
'ййй'=>'0400',
'ййк'=>'0400',
'ййл'=>'0400',
'ййм'=>'0400',
'ййн'=>'0400',
'ййп'=>'0400',
'ййр'=>'0400',
'ййс'=>'0400',
'ййт'=>'0400',
'ййф'=>'0400',
'ййх'=>'0400',
'ййц'=>'0400',
'ййч'=>'0400',
'ййш'=>'0400',
'ййщ'=>'0400',
'йкб'=>'0400',
'йкв'=>'0400',
'йкг'=>'0400',
'йкд'=>'0400',
'йкж'=>'0400',
'йкз'=>'0400',
'йкй'=>'0400',
'йкк'=>'0400',
'йкл'=>'0400',
'йкм'=>'0400',
'йкн'=>'0400',
'йкп'=>'0400',
'йкр'=>'0400',
'йкс'=>'0400',
'йкт'=>'0400',
'йкф'=>'0400',
'йкх'=>'0400',
'йкц'=>'0400',
'йкч'=>'0400',
'йкш'=>'0400',
'йкщ'=>'0400',
'йлб'=>'0400',
'йлв'=>'0400',
'йлг'=>'0400',
'йлд'=>'0400',
'йлж'=>'0400',
'йлз'=>'0400',
'йлй'=>'0400',
'йлк'=>'0400',
'йлл'=>'0400',
'йлм'=>'0400',
'йлн'=>'0400',
'йлп'=>'0400',
'йлр'=>'0400',
'йлс'=>'0400',
'йлт'=>'0400',
'йлф'=>'0400',
'йлх'=>'0400',
'йлц'=>'0400',
'йлч'=>'0400',
'йлш'=>'0400',
'йлщ'=>'0400',
'ймб'=>'0400',
'ймв'=>'0400',
'ймг'=>'0400',
'ймд'=>'0400',
'ймж'=>'0400',
'ймз'=>'0400',
'ймй'=>'0400',
'ймк'=>'0400',
'ймл'=>'0400',
'ймм'=>'0400',
'ймн'=>'0400',
'ймп'=>'0400',
'ймр'=>'0400',
'ймс'=>'0400',
'ймт'=>'0400',
'ймф'=>'0400',
'ймх'=>'0400',
'ймц'=>'0400',
'ймч'=>'0400',
'ймш'=>'0400',
'ймщ'=>'0400',
'йнб'=>'0400',
'йнв'=>'0400',
'йнг'=>'0400',
'йнд'=>'0400',
'йнж'=>'0400',
'йнз'=>'0400',
'йнй'=>'0400',
'йнк'=>'0400',
'йнл'=>'0400',
'йнм'=>'0400',
'йнн'=>'0400',
'йнп'=>'0400',
'йнр'=>'0400',
'йнс'=>'0400',
'йнт'=>'0400',
'йнф'=>'0400',
'йнх'=>'0400',
'йнц'=>'0400',
'йнч'=>'0400',
'йнш'=>'0400',
'йнщ'=>'0400',
'йпб'=>'0400',
'йпв'=>'0400',
'йпг'=>'0400',
'йпд'=>'0400',
'йпж'=>'0400',
'йпз'=>'0400',
'йпй'=>'0400',
'йпк'=>'0400',
'йпл'=>'0400',
'йпм'=>'0400',
'йпн'=>'0400',
'йпп'=>'0400',
'йпр'=>'0400',
'йпс'=>'0400',
'йпт'=>'0400',
'йпф'=>'0400',
'йпх'=>'0400',
'йпц'=>'0400',
'йпч'=>'0400',
'йпш'=>'0400',
'йпщ'=>'0400',
'йрб'=>'0400',
'йрв'=>'0400',
'йрг'=>'0400',
'йрд'=>'0400',
'йрж'=>'0400',
'йрз'=>'0400',
'йрй'=>'0400',
'йрк'=>'0400',
'йрл'=>'0400',
'йрм'=>'0400',
'йрн'=>'0400',
'йрп'=>'0400',
'йрр'=>'0400',
'йрс'=>'0400',
'йрт'=>'0400',
'йрф'=>'0400',
'йрх'=>'0400',
'йрц'=>'0400',
'йрч'=>'0400',
'йрш'=>'0400',
'йрщ'=>'0400',
'йсб'=>'0400',
'йсв'=>'0400',
'йсг'=>'0400',
'йсд'=>'0400',
'йсж'=>'0400',
'йсз'=>'0400',
'йсй'=>'0400',
'йск'=>'0400',
'йсл'=>'0400',
'йсм'=>'0400',
'йсн'=>'0400',
'йсп'=>'0400',
'йср'=>'0400',
'йсс'=>'0400',
'йст'=>'0400',
'йсф'=>'0400',
'йсх'=>'0400',
'йсц'=>'0400',
'йсч'=>'0400',
'йсш'=>'0400',
'йсщ'=>'0400',
'йтб'=>'0400',
'йтв'=>'0400',
'йтг'=>'0400',
'йтд'=>'0400',
'йтж'=>'0400',
'йтз'=>'0400',
'йтй'=>'0400',
'йтк'=>'0400',
'йтл'=>'0400',
'йтм'=>'0400',
'йтн'=>'0400',
'йтп'=>'0400',
'йтр'=>'0400',
'йтс'=>'0400',
'йтт'=>'0400',
'йтф'=>'0400',
'йтх'=>'0400',
'йтц'=>'0400',
'йтч'=>'0400',
'йтш'=>'0400',
'йтщ'=>'0400',
'йфб'=>'0400',
'йфв'=>'0400',
'йфг'=>'0400',
'йфд'=>'0400',
'йфж'=>'0400',
'йфз'=>'0400',
'йфй'=>'0400',
'йфк'=>'0400',
'йфл'=>'0400',
'йфм'=>'0400',
'йфн'=>'0400',
'йфп'=>'0400',
'йфр'=>'0400',
'йфс'=>'0400',
'йфт'=>'0400',
'йфф'=>'0400',
'йфх'=>'0400',
'йфц'=>'0400',
'йфч'=>'0400',
'йфш'=>'0400',
'йфщ'=>'0400',
'йхб'=>'0400',
'йхв'=>'0400',
'йхг'=>'0400',
'йхд'=>'0400',
'йхж'=>'0400',
'йхз'=>'0400',
'йхй'=>'0400',
'йхк'=>'0400',
'йхл'=>'0400',
'йхм'=>'0400',
'йхн'=>'0400',
'йхп'=>'0400',
'йхр'=>'0400',
'йхс'=>'0400',
'йхт'=>'0400',
'йхф'=>'0400',
'йхх'=>'0400',
'йхц'=>'0400',
'йхч'=>'0400',
'йхш'=>'0400',
'йхщ'=>'0400',
'йцб'=>'0400',
'йцв'=>'0400',
'йцг'=>'0400',
'йцд'=>'0400',
'йцж'=>'0400',
'йцз'=>'0400',
'йцй'=>'0400',
'йцк'=>'0400',
'йцл'=>'0400',
'йцм'=>'0400',
'йцн'=>'0400',
'йцп'=>'0400',
'йцр'=>'0400',
'йцс'=>'0400',
'йцт'=>'0400',
'йцф'=>'0400',
'йцх'=>'0400',
'йцц'=>'0400',
'йцч'=>'0400',
'йцш'=>'0400',
'йцщ'=>'0400',
'йчб'=>'0400',
'йчв'=>'0400',
'йчг'=>'0400',
'йчд'=>'0400',
'йчж'=>'0400',
'йчз'=>'0400',
'йчй'=>'0400',
'йчк'=>'0400',
'йчл'=>'0400',
'йчм'=>'0400',
'йчн'=>'0400',
'йчп'=>'0400',
'йчр'=>'0400',
'йчс'=>'0400',
'йчт'=>'0400',
'йчф'=>'0400',
'йчх'=>'0400',
'йчц'=>'0400',
'йчч'=>'0400',
'йчш'=>'0400',
'йчщ'=>'0400',
'йшб'=>'0400',
'йшв'=>'0400',
'йшг'=>'0400',
'йшд'=>'0400',
'йшж'=>'0400',
'йшз'=>'0400',
'йшй'=>'0400',
'йшк'=>'0400',
'йшл'=>'0400',
'йшм'=>'0400',
'йшн'=>'0400',
'йшп'=>'0400',
'йшр'=>'0400',
'йшс'=>'0400',
'йшт'=>'0400',
'йшф'=>'0400',
'йшх'=>'0400',
'йшц'=>'0400',
'йшч'=>'0400',
'йшш'=>'0400',
'йшщ'=>'0400',
'йщб'=>'0400',
'йщв'=>'0400',
'йщг'=>'0400',
'йщд'=>'0400',
'йщж'=>'0400',
'йщз'=>'0400',
'йщй'=>'0400',
'йщк'=>'0400',
'йщл'=>'0400',
'йщм'=>'0400',
'йщн'=>'0400',
'йщп'=>'0400',
'йщр'=>'0400',
'йщс'=>'0400',
'йщт'=>'0400',
'йщф'=>'0400',
'йщх'=>'0400',
'йщц'=>'0400',
'йщч'=>'0400',
'йщш'=>'0400',
'йщщ'=>'0400',
'бь'=>'040',
'вь'=>'040',
'гь'=>'040',
'дь'=>'040',
'жь'=>'040',
'зь'=>'040',
'йь'=>'040',
'кь'=>'040',
'ль'=>'040',
'мь'=>'040',
'нь'=>'040',
'пь'=>'040',
'рь'=>'040',
'сь'=>'040',
'ть'=>'040',
'фь'=>'040',
'хь'=>'040',
'ць'=>'040',
'чь'=>'040',
'шь'=>'040',
'щь'=>'040',
'ьь'=>'040'
)
);

