function StartCalculator(type){
	jDesktop.LoadApp("apps/calculator/startup.js", function(){	
		if(type === 2) _guishCalSciStart();
		else _guishCalStart();			
	});
}

function StartJQPuzzle(){
	jDesktop.LoadApp("apps/games/jqpuzzle/startup.js", function(){ _jqPuzzleStart(); });
}

function StartHelloWorldTutorial(){
	jDesktop.LoadApp("apps/helloWorld/startupTut.js", function() { _helloWorldTutStart(); });
}

function StartWallpaperChanger(){
	var btn1 = '<button type="button" onclick=\'jDesktop.LoadWallpaper("css/images/wallpapers/jDesktop.1.0.v2.jpg","#000000","bottom right", "no-repeat")\'><span><span>Set wallpaper 1</span></span></button><br /><br />';
	var btn2 = '<button type="button" onclick=\'jDesktop.LoadWallpaper("css/images/wallpapers/jDesktop.1.0.jpg","#000000","bottom right", "no-repeat")\'><span><span>Set wallpaper 2</span></span></button>';
	
	jDesktop.StartApp(
		'wallpaperChanger', 
		'Change wallpaper',
		'',			// no js dependencies
		'',			// no css dependencies
		'',			// no app file
		{
			width: 360,
			height: 120,
			resizable: false,
			minimizable: true,
			movable: true
		},
		function(){
			$('#wallpaperChanger').find('div.container').html(btn1 + btn2);
		}
	);
}

function Start_VisitOnlineBuilder(){
	var text = '<p>Visit online window builder at <a style="text-decoration: none" href="http://www.windowbuilder.fractalbrain.net">windowbuilder.fractalbrain.net</a></p><p>for window code generator and documentation</p>';
	
	jDesktop.StartApp(
		'onlineBuilder', 
		'Online window builder',
		'',			// no js dependencies
		'',			// no css dependencies
		'',			// no app file
		{
			width: 360,
			height: -1,
			resizable: false,
			minimizable: false,
			movable: false,
			closable: false,
			yPos: 20,
			xPos: $('#main').width() - 380
		},
		function(){
			$('#onlineBuilder').find('div.container').css('text-align','center').html(text);
		}
	);
}

function StartThemeChanger(){
	jDesktop.StartApp(
		'themeChanger',
		'Select theme',
		'',
		'apps/themeChanger/style.css',
		'apps/themeChanger/tChanger.html',
		{
			width: 300,
			height: 500,
			resizable: false,
			minimizable: true,
			scrollBody: true
		}
	);
}


function Start_WorkingWithOtherPlugins(){
	var intro = '<p>Here you can see how you can use jDesktop with other jQuery plugins to make cool applications.</p>' +
				'<p>Plugins used in these applications:</p><br />' +
				'<p>jQuery calculator - Written by Keith Wood (kbwood{at}iinet.com.au) October 2008. http://keith-wood.name/calculator.html</p>' +
				'<p>jQuery puzzle - Copyright (c) 2008 Ralf Stoltze, http://www.2meter3.de/jqPuzzle/</p><br /><br />' +
				'<p>Both of these plugins are slightly modified to play nicely with jDesktop !</p><br /><br />' +
				'<p>You can find code for calculator app in "apps/calculator/" folder, </p>' +
				'<p>and for puzzle in "apps/games/jqpuzzle/" folder</p><br /><br /><br />';
	var btn1 = '<button type="button" onclick="StartJQPuzzle()"><span><span>Start Puzzle game</span></span></button><br /><br />';
	var btn2 = '<button type="button" onclick="StartCalculator()"><span><span>Start Calculator</span></span></button><br /><br />';
	var btn3 = '<button type="button" onclick="StartCalculator(2)"><span><span>Start Scientific calculator</span></span></button>';
	
	jDesktop.StartApp(
		'demoApps', 
		'Working with other jQuery plugins',
		'',			// no js dependencies
		'',			// no css dependencies
		'',			// no app file
		{
			width: 650,
			height: 380,
			resizable: false,
			minimizable: true,
			closable: true
		},
		function(){
			$('#demoApps').find('div.container').html(intro + btn1 + btn2 + btn3);
		}
	);
}

$(document).ready(function(){

	Start_VisitOnlineBuilder();
	
	$('#myWindow').jWindow({
		width: 1100,
		height: 600,
		resizable: true,
		minimizable: true,
		closable: false
	}).find('div.container').css('overflow','auto').html('<div style="width: 100%; text-align: center;color: #0072ff;"><b style="font-size: 15px; margin: auto;">jDestkop framework 1.0</b></div><br/><br />' +
								  '<b style="color: #4697fc; font-size: 12px;">Overview</b><br /><br />' +
								  '<p>The jDestkop is jQuery plugin/framework for building destkop-like applications for the web. It gives you possibility to make good looking windows that will serve as a containers for your apps. You can minimize/maximize, resize, move windows around. You can change windows themes and wallpapers. And its very easy to use.</p><br />' +
								  '<p>But jDesktop is not only about creating fancy windows. It also provides a nice way to write and organize applications. In order to reduce the size of javascript files initially loaded, jDesktop provides a way to load files needed by your app when they are needed. The idea is to initially (when your site loads) load as small amount of code as possible.</p><br /><br />' +
								  '<p>jDestkop depends on these javascript libraries and jquery plugins:</p></br ><br />' +
								  '<p>Ensure library - Author: 	Omar AL Zabir - http://msmvps.com/blogs/omar</p>' +
								  '<p>jquery.event.drag.js ~ v1.5 ~ Copyright (c) 2008, Three Dub Media (http://threedubmedia.com)</p>' +
								  '<p>jQuery 2d transform library - Copyright 2010, Grady Kuhnline - http://wiki.github.com/heygrady/transform/</p>' +
								  '<p>jQuery pulse library - Copyright (c) 2008 James Padolsey - jp(at)qd9(dot)co.uk | http://james.padolsey.com / http://enhance.qd-creative.co.uk</p><br /><br />' + 								  
								  '<b style="color: #4697fc; font-size: 12px;">How it works</b><br /><br />' +
								  '<p>There is no easy way to explain how jDesktop works because you can organize your file/folder structure as you like.</p>' +
								  '<p>So I will try to explain how this framework works by telling you how I think its best to organize files/folders. I hope you will understand after you read this, and go through `Hello world` tutorial.</p>' +
								  '<p>For index.html file (that you will put in root of your website) you can take the one from helloWorld.rar archive. It is very simple, and there is no need to make changes to this file ever.</p>' +
								  '<p>You should create a `system.js` file in your `site_root/js` folder where jQuery.js and jDesktop libs are stored. This file will contain applications initialization code.</p>' +
								  '<p>You should create an `apps` folder in your site root. This folder will contain all your applications.<p></p>Each application will have its own folder within the `apps` folder and will contain a html file with html code of your app, and also all javascript and css files that this application needs. You can get a good idea on how this all should look if you take a look at `apps` folder of jDesktop framework. Inside of application folder there should be a `startup.js` file that will contain your application construction code (and your application logics).</p>' +
								  '<p>So, in `system.js` file, you define a function that will load your application like this:<p><br /><br />' +
								  '<p>function LoadMyApplication(){</p>' +
								  '<p>&nbsp;&nbsp;jDesktop.LoadApp(" path to apps/myApplication/startup.js file ", function() { Start_MyApplication(); });' +
								  '<p>}</p><br /><br />' +
								  '<p>As you can see, its very short code. You can call your loading function whatever you like. But in the body of this function you must call jDesktop.LoadApp function.</p>' +
								  '<br /><p>jDesktop.LoadApp function expects two parameters:</p>' +
								  '<p>First parameter is path to `startup.js` file that resides in your application folder that itself resides in `apps` folder.</p>' +
								  '<p>Seccond parameter is callback function that will be called when `startup.js` file is loaded.</p>' +
								  '<p>This function is defined in `startup.js` file and it looks like this:</p><br />' +
								  '<p>function Start_MyApplication(){</p>' +
								  '<p>&nbsp;&nbsp;jDesktop.StartApp(</p>' +
							      '<p>&nbsp;&nbsp;&nbsp;&nbsp;"My app ID",</p>' + 
								  '<p>&nbsp;&nbsp;&nbsp;&nbsp;"My app title",</p>' +
								  '<p>&nbsp;&nbsp;&nbsp;&nbsp;"",&nbsp;&nbsp;&nbsp; /*  .js file or array of .js files needed by your app   */</p>' +
								  '<p>&nbsp;&nbsp;&nbsp;&nbsp;"",&nbsp;&nbsp;&nbsp; /*  .css file or array of .css files needed by your app   */</p>' +
								  '<p>&nbsp;&nbsp;&nbsp;&nbsp;"",&nbsp;&nbsp;&nbsp; /*  path to the .html file of your application  */</p>' +
								  '<p>&nbsp;&nbsp;&nbsp;&nbsp;{</p>' +
								  '<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/*  parameters that describes your window width, height, position ...  */</p>' +	
								  '<p>&nbsp;&nbsp;&nbsp;&nbsp;},</p>' +
							      '<p>&nbsp;&nbsp;&nbsp;&nbsp;MyCallback()&nbsp;&nbsp;&nbsp;/*  callback function - here you can call your application logic functions ...  */</p>'	+
								  '<p>}</p><br /><br />' +
								  '<p>Again, you can call Start_MyApplication() function whatever you like , but inside of it you must call jDesktop.StartApp function.</p><br />' +
								  '<p><b>jDesktop.StartApp() function is the heart of jDesktop framework.</b></p><br />' +
								  '<p>And here is the definition of jDestkop.StartApp function:</p><br/>' +
								  '<p>&nbsp;&nbsp;StartApp : function(wID, wTitle, js, css, appPath, wParams, callback)</p><br /><br />' +
								  '<p>You must pass these parameters to it:</p><br />' +
							      '<p><span style="width: 100px; text-align: center; display: block;float:left;">windowID</span><b>Required!</b>&nbsp;&nbsp;First parameter is ID of your application and it must be unique.</p>' +
								  '<p><span style="width: 100px; text-align: center; display: block;float:left;">windowTitle</span><b>Required!</b>&nbsp;&nbsp;Second parameter is title of your app (it will be shown in titlebar of your window)</p>' +
								  '<p><span style="width: 100px; text-align: center; display: block;float:left;">js</span>Third parameter is path to javascript file, or array of paths to .js files that your application depends on. <b>If you dont have any js files you must provide an empty string !!!</b></p>' +
								  '<p><span style="width: 100px; text-align: center; display: block;float:left;">css</span>Fourth parameter is path to css file, or array of paths to .css files that your application depends on. <b>If you dont have any css files you must provide an empty string !!!</b></p>' +
								  '<p><span style="width: 100px; text-align: center; display: block;float:left;">html</span>Fifth parameter is path to .html file of your application. Content of this file will be loaded into your window when it shows up. <b>If there is no html file you must provide an empty string !!!</b></p>' +
								  '<p><span style="width: 100px; text-align: center; display: block;float:left;">windowParams</span><b>Not required.</b> Sixth parameter is key-value collection that will define your windows look and behaviour:</p>' +
								  '<span style="width: 100px; text-align: center; display: block;float:left;">&nbsp;</span><p>{</p>' +
								  '<p><span style="width: 100px; text-align: center; display: block;float:left;">&nbsp;</span>&nbsp;&nbsp;minimizable: default=false,</p>' +
								  '<p><span style="width: 100px; text-align: center; display: block;float:left;">&nbsp;</span>&nbsp;&nbsp;movable: default=true,</p>' +
								  '<p><span style="width: 100px; text-align: center; display: block;float:left;">&nbsp;</span>&nbsp;&nbsp;closable: true,</p>' +
								  '<p><span style="width: 100px; text-align: center; display: block;float:left;">&nbsp;</span>&nbsp;&nbsp;closeConfirm: default=false,</p>' +
								  '<p><span style="width: 100px; text-align: center; display: block;float:left;">&nbsp;</span>&nbsp;&nbsp;resizable: default=true,</p>' +
								  '<p><span style="width: 100px; text-align: center; display: block;float:left;">&nbsp;</span>&nbsp;&nbsp;isChild: default=false,</p>' +
								  '<p><span style="width: 100px; text-align: center; display: block;float:left;">&nbsp;</span>&nbsp;&nbsp;xPos: default=-1(centered horizontaly),</p>' +
								  '<p><span style="width: 100px; text-align: center; display: block;float:left;">&nbsp;</span>&nbsp;&nbsp;yPos: default=-1(centered verticaly),</p>' + 
								  '<p><span style="width: 100px; text-align: center; display: block;float:left;">&nbsp;</span>&nbsp;&nbsp;width: default=400,</p>' +
								  '<p><span style="width: 100px; text-align: center; display: block;float:left;">&nbsp;</span>&nbsp;&nbsp;height: default=300,</p>' +
								  '<p><span style="width: 100px; text-align: center; display: block;float:left;">&nbsp;</span>&nbsp;&nbsp;scrollBody: default=false,	/*  if you want your window to have scrollbar, you control css overflow property with this  */</p>' +
								  '<p><span style="width: 100px; text-align: center; display: block;float:left;">&nbsp;</span>&nbsp;&nbsp;onResizeStart: function to call when window resizing starts ,</p>' +
								  '<p><span style="width: 100px; text-align: center; display: block;float:left;">&nbsp;</span>&nbsp;&nbsp;onResizeEnd:   function to call when window resizing ends ,</p>' +								  
								  '<p><span style="width: 100px; text-align: center; display: block;float:left;">&nbsp;</span>&nbsp;&nbsp;onBeforeStart: function to call just before window pops up ,</p>' +
								  '<p><span style="width: 100px; text-align: center; display: block;float:left;">&nbsp;</span>&nbsp;&nbsp;onStart: function to call when window shows up ,</p>' +
								  '<p><span style="width: 100px; text-align: center; display: block;float:left;">&nbsp;</span>&nbsp;&nbsp;onBeforeClose: function to call just before winodow is destroyed ,</p>' +
								  '<p><span style="width: 100px; text-align: center; display: block;float:left;">&nbsp;</span>&nbsp;&nbsp;onClose: function to call when window is destroyed</p>' +
								  '<p><span style="width: 100px; text-align: center; display: block;float:left;">&nbsp;</span>}</p>' +
								  '<p><span style="width: 100px; text-align: center; display: block;float:left;">callbackFunction</span><b>Not required.</b> Here you can call your application logic function ...</p><br /><br />' +
								  '<p>Here is simplest call to jDestkop.StartApp function:</p><br />' +
								  '<p>jDesktop.StartApp{</p>' +
								  '<p>&nbsp;&nbsp;&nbsp;"someID",</p>' +
								  '<p>&nbsp;&nbsp;&nbsp;"This is a window",</p>' +
								  '<p>&nbsp;&nbsp;&nbsp;"",</p>' +
								  '<p>&nbsp;&nbsp;&nbsp;"",</p>' +
								  '<p>&nbsp;&nbsp;&nbsp;""</p>' +
								  '<p>}</p><br /><br />' +
								  '<p>Here, we are creating a simple window with default parameters. Click the button below to see the effect of this code.</p><br /><br />' +
								  '<button type="button" onclick=\'jDesktop.StartApp("someID", "This is a window", "", "", "")\'><span><span>Click to see the effect</span></span></button><br /><br /><br /><br />' +
								  '<p>That was easy ! And if you like the button, it is built into jDesktop. Here\'s the html code for it:</p><br />' +
								  '<p>&nbsp;&nbsp;&nbsp;&nbsp;&lt;button type="button"&gt;&lt;span&gt;&lt;span&gt;Button Text&lt;/span&gt;&lt;/span&gt;&lt;/button&gt;</p><br />' +
								  '<p>Now lets move to "Hello world" tutorial ...</p><br /><br />' +
								  '<button type="button" onclick=\'StartHelloWorldTutorial()\'><span><span>Hello world tutorial</span></span></button><br /><br /><br /><br />' +
								  '<b style="color: #4697fc; font-size: 12px;">Demos</b><br /><br />' +
								  '<p>Try some demo applications that were built with help of some cool jQuery plugins:</p><br /><br />' +
								  '<button type="button" onclick="Start_WorkingWithOtherPlugins()"><span><span>Open demos</span></span></button><br /><br /><br /><br />' +
								  '<b style="color: #4697fc; font-size: 12px;">Changing windows theme/skin and wallpapers</b><br /><br />' +
								  '<p>jDesktop provides function jDesktop.ChangeSkin(skinName) .</p><br />' +
								  '<p>Parameter skinName is path to folder that contains images for window skin</p>' +
								  '<p>jDesktop framework contains 32 skins.</p><br />' +
								  '<button type="button" onclick="StartThemeChanger()"><span><span>Change window theme</span></span></button><br /><br /><br />' +
								  '<p>There is also function for changing wallpaper:</p><br />' +
								  '<p>jDesktop.LoadWallpaper(src, bkgColor, position, repeat)</p><br />' +
								  '<p>Parameters are:</p><br />' +
								  '<p>src - path to the image</p>' +
								  '<p>bkgColor - setting background color if your image is small and you want the rest of the screen colored</p>' +
								  '<p>position - standard css background-position property ( like: center center )</p>' +
								  '<p>repeat   - standard css background-repeat property ( no-repeat or repeat or repeat-x or repeat-y )</p><br />' +
								  '<p>Why did I wrote this function this way ?? Wasn\'t it easier to write a function that accepts single parameter ???</p><br /><br />' +
								  '<button type="button" onclick="StartWallpaperChanger()"><span><span>Change wallpaper</span></span></button><br /><br /><br />'
								  );
	
	
});	


