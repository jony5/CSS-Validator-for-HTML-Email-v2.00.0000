/*!
* jQuery Mobile 1.4.5
* Git HEAD hash: 68e55e78b292634d3991c795f06f5e37a512decc <> Date: Fri Oct 31 2014 17:33:30 UTC
* http://jquerymobile.com
*
* Copyright 2010, 2014 jQuery Foundation, Inc. and othercontributors
* Released under the MIT license.
* http://jquery.org/license
*
*/


/* Globals */
/* Font
-----------------------------------------------------------------------------------------------------------*/
html {
	font-size: 100%;
}
body,
input,
select,
textarea,
button,
.ui-btn {
	font-size: 1em;
	line-height: 1.3;
	font-family: sans-serif /*{global-font-family}*/;
}
legend,
.ui-input-text input,
.ui-input-search input {
	color: inherit;
	text-shadow: inherit;
}
/* Form labels (overrides font-weight bold in bars, and mini font-size) */
.ui-mobile label,
div.ui-controlgroup-label {
	font-weight: normal;
	font-size: 16px;
}
/* Separators
-----------------------------------------------------------------------------------------------------------*/
/* Field contain separator (< 28em) */
.ui-field-contain {
	border-bottom-color: #828282;
	border-bottom-color: rgba(0,0,0,.15);
	border-bottom-width: 1px;
	border-bottom-style: solid;
}
/* Table opt-in classes: strokes between each row, and alternating row stripes */
/* Classes table-stroke and table-stripe are deprecated in 1.4. */
.table-stroke thead th,
.table-stripe thead th,
.table-stripe tbody tr:last-child {
	border-bottom: 1px solid #d6d6d6; /* non-RGBA fallback */
	border-bottom: 1px solid rgba(0,0,0,.1);
}
.table-stroke tbody th,
.table-stroke tbody td {
	border-bottom: 1px solid #e6e6e6; /* non-RGBA fallback  */
	border-bottom: 1px solid rgba(0,0,0,.05);
}
.table-stripe.table-stroke tbody tr:last-child th,
.table-stripe.table-stroke tbody tr:last-child td {
	border-bottom: 0;
}
.table-stripe tbody tr:nth-child(odd) td,
.table-stripe tbody tr:nth-child(odd) th {
	background-color: #eeeeee; /* non-RGBA fallback  */
	background-color: rgba(0,0,0,.04);
}
/* Buttons
-----------------------------------------------------------------------------------------------------------*/
.ui-btn,
label.ui-btn {
	font-weight: bold;
	border-width: 1px;
	border-style: solid;
}
.ui-btn {
	text-decoration: none !important;
}
.ui-btn-active {
	cursor: pointer;
}
/* Corner rounding
-----------------------------------------------------------------------------------------------------------*/
/* Class ui-btn-corner-all deprecated in 1.4 */
.ui-corner-all {
	-webkit-border-radius: 				.3125em /*{global-radii-blocks}*/;
	border-radius: 						.3125em /*{global-radii-blocks}*/;
}
/* Buttons */
.ui-btn-corner-all,
.ui-btn.ui-corner-all,
/* Slider track */
.ui-slider-track.ui-corner-all,
/* Flipswitch */
.ui-flipswitch.ui-corner-all,
/* Count bubble */
.ui-li-count {
	-webkit-border-radius: 				.3125em /*{global-radii-buttons}*/;
	border-radius: 						.3125em /*{global-radii-buttons}*/;
}
/* Icon-only buttons */
.ui-btn-icon-notext.ui-btn-corner-all,
.ui-btn-icon-notext.ui-corner-all {
	-webkit-border-radius: 1em;
	border-radius: 1em;
}
/* Radius clip workaround for cleaning up corner trapping */
.ui-btn-corner-all,
.ui-corner-all {
	-webkit-background-clip: padding;
	background-clip: padding-box;
}
/* Popup arrow */
.ui-popup.ui-corner-all > .ui-popup-arrow-guide {
	left: .6em /*{global-radii-blocks}*/;
	right: .6em /*{global-radii-blocks}*/;
	top: .6em /*{global-radii-blocks}*/;
	bottom: .6em /*{global-radii-blocks}*/;
}
/* Shadow
-----------------------------------------------------------------------------------------------------------*/
.ui-shadow {
	-webkit-box-shadow: 0 1px 3px /*{global-box-shadow-size}*/ 		rgba(0,0,0,.15) /*{global-box-shadow-color}*/;
	-moz-box-shadow: 0 1px 3px /*{global-box-shadow-size}*/ 		rgba(0,0,0,.15) /*{global-box-shadow-color}*/;
	box-shadow: 0 1px 3px /*{global-box-shadow-size}*/ 				rgba(0,0,0,.15) /*{global-box-shadow-color}*/;
}
.ui-shadow-inset {
	-webkit-box-shadow: inset 0 1px 3px /*{global-box-shadow-size}*/ 	rgba(0,0,0,.2) /*{global-box-shadow-color}*/;
	-moz-box-shadow: inset 0 1px 3px /*{global-box-shadow-size}*/ 		rgba(0,0,0,.2) /*{global-box-shadow-color}*/;
	box-shadow: inset 0 1px 3px /*{global-box-shadow-size}*/ 	rgba(0,0,0,.2) /*{global-box-shadow-color}*/;
}
.ui-overlay-shadow {
	-webkit-box-shadow: 0 0 12px 		rgba(0,0,0,.6);
	-moz-box-shadow: 0 0 12px 			rgba(0,0,0,.6);
	box-shadow: 0 0 12px 				rgba(0,0,0,.6);
}
/* Icons
-----------------------------------------------------------------------------------------------------------*/
.ui-btn-icon-left:after,
.ui-btn-icon-right:after,
.ui-btn-icon-top:after,
.ui-btn-icon-bottom:after,
.ui-btn-icon-notext:after {
	background-color: 					#666 /*{global-icon-color}*/;
	background-color: 					rgba(0,0,0,.3) /*{global-icon-disc}*/;
	background-position: center center;
	background-repeat: no-repeat;
	-webkit-border-radius: 1em;
	border-radius: 1em;
}
/* Alt icons */
.ui-alt-icon.ui-btn:after,
.ui-alt-icon .ui-btn:after,
html .ui-alt-icon.ui-checkbox-off:after,
html .ui-alt-icon.ui-radio-off:after,
html .ui-alt-icon .ui-checkbox-off:after,
html .ui-alt-icon .ui-radio-off:after {
	background-color: 					#666 /*{global-icon-color}*/;
	background-color: 					rgba(0,0,0,.15) /*{global-icon-disc}*/;
}
/* No disc */
.ui-nodisc-icon.ui-btn:after,
.ui-nodisc-icon .ui-btn:after {
	background-color: transparent;
}
/* Icon shadow */
.ui-shadow-icon.ui-btn:after,
.ui-shadow-icon .ui-btn:after {
	-webkit-box-shadow: 0 1px 0 			rgba(255,255,255,.3) /*{global-icon-shadow}*/;
	-moz-box-shadow: 0 1px 0 				rgba(255,255,255,.3) /*{global-icon-shadow}*/;
	box-shadow: 0 1px 0 					rgba(255,255,255,.3) /*{global-icon-shadow}*/;
}
/* Checkbox and radio */
.ui-btn.ui-checkbox-off:after,
.ui-btn.ui-checkbox-on:after,
.ui-btn.ui-radio-off:after,
.ui-btn.ui-radio-on:after {
	display: block;
	width: 18px;
	height: 18px;
	margin: -9px 2px 0 2px;
}
.ui-checkbox-off:after,
.ui-btn.ui-radio-off:after {
	filter: Alpha(Opacity=30);
	opacity: .3;
}
.ui-btn.ui-checkbox-off:after,
.ui-btn.ui-checkbox-on:after {
	-webkit-border-radius: .1875em;
	border-radius: .1875em;
}
.ui-btn.ui-checkbox-off:after {
	background-color: #666;
	background-color: rgba(0,0,0,.3);
}
.ui-radio .ui-btn.ui-radio-on:after {
	background-image: none;
	background-color: #fff;
	width: 8px;
	height: 8px;
	border-width: 5px;
	border-style: solid; 
}
.ui-alt-icon.ui-btn.ui-radio-on:after,
.ui-alt-icon .ui-btn.ui-radio-on:after {
	background-color: #000;
}
/* Loader */
.ui-icon-loading {
	background: url("images/ajax-loader.gif");
	background-size: 2.875em 2.875em;
}
/* Swatches */
/* A
-----------------------------------------------------------------------------------------------------------*/
/* Bar: Toolbars, dividers, slider track */
.ui-bar-a,
.ui-page-theme-a .ui-bar-inherit,
html .ui-bar-a .ui-bar-inherit,
html .ui-body-a .ui-bar-inherit,
html body .ui-group-theme-a .ui-bar-inherit {
	background-color: 			#e9e9e9 /*{a-bar-background-color}*/;
	border-color:	 		#ddd /*{a-bar-border}*/;
	color: 					#333 /*{a-bar-color}*/;
	text-shadow: 0 /*{a-bar-shadow-x}*/ 1px /*{a-bar-shadow-y}*/ 0 /*{a-bar-shadow-radius}*/ 	#eee /*{a-bar-shadow-color}*/;
	font-weight: bold;
}
.ui-bar-a {
	border-width: 1px;
	border-style: solid;
}
/* Page and overlay */
.ui-overlay-a,
.ui-page-theme-a,
.ui-page-theme-a .ui-panel-wrapper {
	background-color: 			#f9f9f9 /*{a-page-background-color}*/;
	border-color:	 		#bbb /*{a-page-border}*/;
	color: 					#333 /*{a-page-color}*/;
	text-shadow: 0 /*{a-page-shadow-x}*/ 1px /*{a-page-shadow-y}*/ 0 /*{a-page-shadow-radius}*/ 	#f3f3f3 /*{a-page-shadow-color}*/;
}
/* Body: Read-only lists, text inputs, collapsible content */
.ui-body-a,
.ui-page-theme-a .ui-body-inherit,
html .ui-bar-a .ui-body-inherit,
html .ui-body-a .ui-body-inherit,
html body .ui-group-theme-a .ui-body-inherit,
html .ui-panel-page-container-a {
	background-color: 			#fff /*{a-body-background-color}*/;
	border-color:	 		#ddd /*{a-body-border}*/;
	color: 					#333 /*{a-body-color}*/;
	text-shadow: 0 /*{a-body-shadow-x}*/ 1px /*{a-body-shadow-y}*/ 0 /*{a-body-shadow-radius}*/ 	#f3f3f3 /*{a-body-shadow-color}*/;
}
.ui-body-a {
	border-width: 1px;
	border-style: solid;
}
/* Links */
.ui-page-theme-a a,
html .ui-bar-a a,
html .ui-body-a a,
html body .ui-group-theme-a a {
	color: #3388cc /*{a-link-color}*/;
	font-weight: bold;
}
.ui-page-theme-a a:visited,
html .ui-bar-a a:visited,
html .ui-body-a a:visited,
html body .ui-group-theme-a a:visited {
    color: #3388cc /*{a-link-visited}*/;
}
.ui-page-theme-a a:hover,
html .ui-bar-a a:hover,
html .ui-body-a a:hover,
html body .ui-group-theme-a a:hover {
	color: #005599 /*{a-link-hover}*/;
}
.ui-page-theme-a a:active,
html .ui-bar-a a:active,
html .ui-body-a a:active,
html body .ui-group-theme-a a:active {
	color: #005599 /*{a-link-active}*/;
}
/* Button up */
.ui-page-theme-a .ui-btn,
html .ui-bar-a .ui-btn,
html .ui-body-a .ui-btn,
html body .ui-group-theme-a .ui-btn,
html head + body .ui-btn.ui-btn-a,
/* Button visited */
.ui-page-theme-a .ui-btn:visited,
html .ui-bar-a .ui-btn:visited,
html .ui-body-a .ui-btn:visited,
html body .ui-group-theme-a .ui-btn:visited,
html head + body .ui-btn.ui-btn-a:visited {
	background-color: 			#f6f6f6 /*{a-bup-background-color}*/;
	border-color:	 		#ddd /*{a-bup-border}*/;
	color: 					#333 /*{a-bup-color}*/;
	text-shadow: 0 /*{a-bup-shadow-x}*/ 1px /*{a-bup-shadow-y}*/ 0 /*{a-bup-shadow-radius}*/ #f3f3f3 /*{a-bup-shadow-color}*/;
}
/* Button hover */
.ui-page-theme-a .ui-btn:hover,
html .ui-bar-a .ui-btn:hover,
html .ui-body-a .ui-btn:hover,
html body .ui-group-theme-a .ui-btn:hover,
html head + body .ui-btn.ui-btn-a:hover {
	background-color: 			#ededed /*{a-bhover-background-color}*/;
	border-color:	 		#ddd /*{a-bhover-border}*/;
	color: 					#333 /*{a-bhover-color}*/;
	text-shadow: 0 /*{a-bhover-shadow-x}*/ 1px /*{a-bhover-shadow-y}*/ 0 /*{a-bhover-shadow-radius}*/ #f3f3f3 /*{a-bhover-shadow-color}*/;
}
/* Button down */
.ui-page-theme-a .ui-btn:active,
html .ui-bar-a .ui-btn:active,
html .ui-body-a .ui-btn:active,
html body .ui-group-theme-a .ui-btn:active,
html head + body .ui-btn.ui-btn-a:active {
	background-color: 			#e8e8e8 /*{a-bdown-background-color}*/;
	border-color:	 		#ddd /*{a-bdown-border}*/;
	color: 					#333 /*{a-bdown-color}*/;
	text-shadow: 0 /*{a-bdown-shadow-x}*/ 1px /*{a-bdown-shadow-y}*/ 0 /*{a-bdown-shadow-radius}*/ #f3f3f3 /*{a-bdown-shadow-color}*/;
}
/* Active button */
.ui-page-theme-a .ui-btn.ui-btn-active,
html .ui-bar-a .ui-btn.ui-btn-active,
html .ui-body-a .ui-btn.ui-btn-active,
html body .ui-group-theme-a .ui-btn.ui-btn-active,
html head + body .ui-btn.ui-btn-a.ui-btn-active,
/* Active checkbox icon */
.ui-page-theme-a .ui-checkbox-on:after,
html .ui-bar-a .ui-checkbox-on:after,
html .ui-body-a .ui-checkbox-on:after,
html body .ui-group-theme-a .ui-checkbox-on:after,
.ui-btn.ui-checkbox-on.ui-btn-a:after,
/* Active flipswitch background */
.ui-page-theme-a .ui-flipswitch-active,
html .ui-bar-a .ui-flipswitch-active,
html .ui-body-a .ui-flipswitch-active,
html body .ui-group-theme-a .ui-flipswitch-active,
html body .ui-flipswitch.ui-bar-a.ui-flipswitch-active,
/* Active slider track */
.ui-page-theme-a .ui-slider-track .ui-btn-active,
html .ui-bar-a .ui-slider-track .ui-btn-active,
html .ui-body-a .ui-slider-track .ui-btn-active,
html body .ui-group-theme-a .ui-slider-track .ui-btn-active,
html body div.ui-slider-track.ui-body-a .ui-btn-active {
	background-color: 		#3388cc /*{a-active-background-color}*/;
	border-color:	 		#3388cc /*{a-active-border}*/;
	color: 					#fff /*{a-active-color}*/;
	text-shadow: 0 /*{a-active-shadow-x}*/ 1px /*{a-active-shadow-y}*/ 0 /*{a-active-shadow-radius}*/ #005599 /*{a-active-shadow-color}*/;
}
/* Active radio button icon */
.ui-page-theme-a .ui-radio-on:after,
html .ui-bar-a .ui-radio-on:after,
html .ui-body-a .ui-radio-on:after,
html body .ui-group-theme-a .ui-radio-on:after,
.ui-btn.ui-radio-on.ui-btn-a:after {
	border-color:			#3388cc /*{a-active-background-color}*/;
}
/* Focus */
.ui-page-theme-a .ui-btn:focus,
html .ui-bar-a .ui-btn:focus,
html .ui-body-a .ui-btn:focus,
html body .ui-group-theme-a .ui-btn:focus,
html head + body .ui-btn.ui-btn-a:focus,
/* Focus buttons and text inputs with div wrap */
.ui-page-theme-a .ui-focus,
html .ui-bar-a .ui-focus,
html .ui-body-a .ui-focus,
html body .ui-group-theme-a .ui-focus,
html head + body .ui-btn-a.ui-focus,
html head + body .ui-body-a.ui-focus {
	-webkit-box-shadow: 0 0 12px 	#3388cc /*{a-active-background-color}*/;
	-moz-box-shadow: 0 0 12px 		#3388cc /*{a-active-background-color}*/;
	box-shadow: 0 0 12px 			#3388cc /*{a-active-background-color}*/;
}
/* B
-----------------------------------------------------------------------------------------------------------*/
/* Bar: Toolbars, dividers, slider track */
.ui-bar-b,
.ui-page-theme-b .ui-bar-inherit,
html .ui-bar-b .ui-bar-inherit,
html .ui-body-b .ui-bar-inherit,
html body .ui-group-theme-b .ui-bar-inherit {
	background-color: 			#1d1d1d /*{b-bar-background-color}*/;
	border-color:	 		#1b1b1b /*{b-bar-border}*/;
	color: 					#fff /*{b-bar-color}*/;
	text-shadow: 0 /*{b-bar-shadow-x}*/ 1px /*{b-bar-shadow-y}*/ 0 /*{b-bar-shadow-radius}*/ 	#111 /*{b-bar-shadow-color}*/;
	font-weight: bold;
}
.ui-bar-b {
	border-width: 1px;
	border-style: solid;
}
/* Page and overlay */
.ui-overlay-b,
.ui-page-theme-b,
.ui-page-theme-b .ui-panel-wrapper {
	background-color: 			#252525 /*{b-page-background-color}*/;
	border-color:	 		#454545 /*{b-page-border}*/;
	color: 					#fff /*{b-page-color}*/;
	text-shadow: 0 /*{b-page-shadow-x}*/ 1px /*{b-page-shadow-y}*/ 0 /*{b-page-shadow-radius}*/ 	#111 /*{b-page-shadow-color}*/;
}
/* Body: Read-only lists, text inputs, collapsible content */
.ui-body-b,
.ui-page-theme-b .ui-body-inherit,
html .ui-bar-b .ui-body-inherit,
html .ui-body-b .ui-body-inherit,
html body .ui-group-theme-b .ui-body-inherit,
html .ui-panel-page-container-b {
	background-color: 			#2a2a2a /*{b-body-background-color}*/;
	border-color:	 		#1d1d1d /*{b-body-border}*/;
	color: 					#fff /*{b-body-color}*/;
	text-shadow: 0 /*{b-body-shadow-x}*/ 1px /*{b-body-shadow-y}*/ 0 /*{b-body-shadow-radius}*/ 	#111 /*{b-body-shadow-color}*/;
}
.ui-body-b {
	border-width: 1px;
	border-style: solid;
}
/* Links */
.ui-page-theme-b a,
html .ui-bar-b a,
html .ui-body-b a,
html body .ui-group-theme-b a {
	color: #22aadd /*{b-link-color}*/;
	font-weight: bold;
}
.ui-page-theme-b a:visited,
html .ui-bar-b a:visited,
html .ui-body-b a:visited,
html body .ui-group-theme-b a:visited {
    color: #22aadd /*{b-link-visited}*/;
}
.ui-page-theme-b a:hover,
html .ui-bar-b a:hover,
html .ui-body-b a:hover,
html body .ui-group-theme-b a:hover {
	color: #0088bb /*{b-link-hover}*/;
}
.ui-page-theme-b a:active,
html .ui-bar-b a:active,
html .ui-body-b a:active,
html body .ui-group-theme-b a:active {
	color: #0088bb /*{b-link-active}*/;
}
/* Button up */
.ui-page-theme-b .ui-btn,
html .ui-bar-b .ui-btn,
html .ui-body-b .ui-btn,
html body .ui-group-theme-b .ui-btn,
html head + body .ui-btn.ui-btn-b,
/* Button visited */
.ui-page-theme-b .ui-btn:visited,
html .ui-bar-b .ui-btn:visited,
html .ui-body-b .ui-btn:visited,
html body .ui-group-theme-b .ui-btn:visited,
html head + body .ui-btn.ui-btn-b:visited {
	background-color: 			#333 /*{b-bup-background-color}*/;
	border-color:	 		#1f1f1f /*{b-bup-border}*/;
	color: 					#fff /*{b-bup-color}*/;
	text-shadow: 0 /*{b-bup-shadow-x}*/ 1px /*{b-bup-shadow-y}*/ 0 /*{b-bup-shadow-radius}*/ #111 /*{b-bup-shadow-color}*/;
}
/* Button hover */
.ui-page-theme-b .ui-btn:hover,
html .ui-bar-b .ui-btn:hover,
html .ui-body-b .ui-btn:hover,
html body .ui-group-theme-b .ui-btn:hover,
html head + body .ui-btn.ui-btn-b:hover {
	background-color: 			#373737 /*{b-bhover-background-color}*/;
	border-color:	 		#1f1f1f /*{b-bhover-border}*/;
	color: 					#fff /*{b-bhover-color}*/;
	text-shadow: 0 /*{b-bhover-shadow-x}*/ 1px /*{b-bhover-shadow-y}*/ 0 /*{b-bhover-shadow-radius}*/ #111 /*{b-bhover-shadow-color}*/;
}
/* Button down */
.ui-page-theme-b .ui-btn:active,
html .ui-bar-b .ui-btn:active,
html .ui-body-b .ui-btn:active,
html body .ui-group-theme-b .ui-btn:active,
html head + body .ui-btn.ui-btn-b:active {
	background-color: 			#404040 /*{b-bdown-background-color}*/;
	border-color:	 		#1f1f1f /*{b-bdown-border}*/;
	color: 					#fff /*{b-bdown-color}*/;
	text-shadow: 0 /*{b-bdown-shadow-x}*/ 1px /*{b-bdown-shadow-y}*/ 0 /*{b-bdown-shadow-radius}*/ #111 /*{b-bdown-shadow-color}*/;
}
/* Active button */
.ui-page-theme-b .ui-btn.ui-btn-active,
html .ui-bar-b .ui-btn.ui-btn-active,
html .ui-body-b .ui-btn.ui-btn-active,
html body .ui-group-theme-b .ui-btn.ui-btn-active,
html head + body .ui-btn.ui-btn-b.ui-btn-active,
/* Active checkbox icon */
.ui-page-theme-b .ui-checkbox-on:after,
html .ui-bar-b .ui-checkbox-on:after,
html .ui-body-b .ui-checkbox-on:after,
html body .ui-group-theme-b .ui-checkbox-on:after,
.ui-btn.ui-checkbox-on.ui-btn-b:after,
/* Active flipswitch background */
.ui-page-theme-b .ui-flipswitch-active,
html .ui-bar-b .ui-flipswitch-active,
html .ui-body-b .ui-flipswitch-active,
html body .ui-group-theme-b .ui-flipswitch-active,
html body .ui-flipswitch.ui-bar-b.ui-flipswitch-active,
/* Active slider track */
.ui-page-theme-b .ui-slider-track .ui-btn-active,
html .ui-bar-b .ui-slider-track .ui-btn-active,
html .ui-body-b .ui-slider-track .ui-btn-active,
html body .ui-group-theme-b .ui-slider-track .ui-btn-active,
html body div.ui-slider-track.ui-body-b .ui-btn-active {
	background-color: 		#22aadd /*{b-active-background-color}*/;
	border-color:	 		#22aadd /*{b-active-border}*/;
	color: 					#fff /*{b-active-color}*/;
	text-shadow: 0 /*{b-active-shadow-x}*/ 1px /*{b-active-shadow-y}*/ 0 /*{b-active-shadow-radius}*/ #0088bb /*{b-active-shadow-color}*/;
}
/* Active radio button icon */
.ui-page-theme-b .ui-radio-on:after,
html .ui-bar-b .ui-radio-on:after,
html .ui-body-b .ui-radio-on:after,
html body .ui-group-theme-b .ui-radio-on:after,
.ui-btn.ui-radio-on.ui-btn-b:after {
	border-color:			#22aadd /*{b-active-background-color}*/;
}
/* Focus */
.ui-page-theme-b .ui-btn:focus,
html .ui-bar-b .ui-btn:focus,
html .ui-body-b .ui-btn:focus,
html body .ui-group-theme-b .ui-btn:focus,
html head + body .ui-btn.ui-btn-b:focus,
/* Focus buttons and text inputs with div wrap */
.ui-page-theme-b .ui-focus,
html .ui-bar-b .ui-focus,
html .ui-body-b .ui-focus,
html body .ui-group-theme-b .ui-focus,
html head + body .ui-btn-b.ui-focus,
html head + body .ui-body-b.ui-focus {
	-webkit-box-shadow: 0 0 12px 	#22aadd /*{b-active-background-color}*/;
	-moz-box-shadow: 0 0 12px 		#22aadd /*{b-active-background-color}*/;
	box-shadow: 0 0 12px 			#22aadd /*{b-active-background-color}*/;
}
/* Structure */
/* Disabled
-----------------------------------------------------------------------------------------------------------*/
/* Class ui-disabled deprecated in 1.4. :disabled not supported by IE8 so we use [disabled] */
.ui-disabled,
.ui-state-disabled,
button[disabled],
.ui-select .ui-btn.ui-state-disabled {
	filter: Alpha(Opacity=30);
	opacity: .3;
	cursor: default !important;
	pointer-events: none;
}
/* Focus state outline
-----------------------------------------------------------------------------------------------------------*/
.ui-btn:focus,
.ui-btn.ui-focus {
	outline: 0;
}
/* Unset box-shadow in browsers that don't do it right */
.ui-noboxshadow .ui-shadow,
.ui-noboxshadow .ui-shadow-inset,
.ui-noboxshadow .ui-overlay-shadow,
.ui-noboxshadow .ui-shadow-icon.ui-btn:after,
.ui-noboxshadow .ui-shadow-icon .ui-btn:after,
.ui-noboxshadow .ui-focus,
.ui-noboxshadow .ui-btn:focus,
.ui-noboxshadow  input:focus,
.ui-noboxshadow .ui-panel {
	-webkit-box-shadow: none !important;
	-moz-box-shadow: none !important;
	box-shadow: none !important;
}
.ui-noboxshadow .ui-btn:focus,
.ui-noboxshadow .ui-focus {
	outline-width: 1px;
	outline-style: auto;
}
