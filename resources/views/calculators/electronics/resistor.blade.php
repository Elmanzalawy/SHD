@extends('layouts.app')
@section('content')
<style>
body{
    margin-top: 56px !important;
}
label{
    margin-top: 1rem;
}
#resistor-wrapper{
    display: flex;
    justify-content: center;
}
.box{
    width:50px;
    height:50px;
    margin: 10px;
    background:#444;
    display: inline-block;
}
svg{
    /* transform:rotateZ(225deg); */
    margin-top: 2rem;
    transform:scale(2);

}
</style>

<div class="container">
<div class="jumbotron">
    <h2 class="center">Current Resistor Calculator (Beta)</h2>
<form action="" class="form-group">
    <label for="band-1" class="">Band 1</label>
    <select id="select-band-1" onchange="updateResistance();" class="band-select form-control" type="text" placeholder="Band 1" name="band-1">
    </select>
    <label for="band-2">Band 2</label>
    <select id="select-band-2" onchange="updateResistance();" class="band-select form-control" type="text" placeholder="Band 1" name="band-1">
    </select>
    <label for="band-3">Band 3</label>
    <select id="select-band-3" onchange="updateResistance();" class="band-select form-control" type="text" placeholder="Band 1" name="band-1">
    </select>
    <label for="band-4">Band 4</label>
    <select id="select-band-4" onchange="updateResistance();" class="tolerance-select form-control" type="text" placeholder="Band 1" name="band-1">
    </select>
</form>
<div id="resistor-wrapper">
 <svg xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:cc="http://creativecommons.org/ns#" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd" xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" version="1.0" width="200" height="120" id="svg2" sodipodi:docname="4-Band_Resistor-ne.svg" inkscape:version="0.92.4 (5da689c313, 2019-01-14)">
            <metadata id="metadata31">
              <rdf:RDF>
                <cc:Work rdf:about="">
                  <dc:format>image/svg+xml</dc:format>
                  <dc:type rdf:resource="http://purl.org/dc/dcmitype/StillImage"/>
                  <dc:title/>
                </cc:Work>
              </rdf:RDF>
            </metadata>
            <sodipodi:namedview pagecolor="#ffffff" bordercolor="#666666" borderopacity="1" objecttolerance="10" gridtolerance="10" guidetolerance="10" inkscape:pageopacity="0" inkscape:pageshadow="2" inkscape:window-width="1366" inkscape:window-height="705" id="namedview29" showgrid="false" inkscape:zoom="1.42" inkscape:cx="100" inkscape:cy="60" inkscape:window-x="-8" inkscape:window-y="-8" inkscape:window-maximized="1" inkscape:current-layer="layer1"/>
            <defs id="defs4">
              <linearGradient id="linearGradient3938">
                <stop style="stop-color:#d57c00;stop-opacity:1" offset="0" id="stop3940"/>
                <stop style="stop-color:#d57c00;stop-opacity:0.74901962" offset="0.25" id="stop3948"/>
                <stop style="stop-color:#d57c00;stop-opacity:0.49803922" offset="1" id="stop3946"/>
              </linearGradient>
              <linearGradient x1="120" y1="45.5" x2="130" y2="45.5" id="linearGradient9206" xlink:href="#linearGradient3938" gradientUnits="userSpaceOnUse" gradientTransform="translate(7.702266e-2,0.404888)"/>
            </defs>
            <g id="layer1"> 
              <path class="band-1" d="M 60.077022,20.404888 L 60.077022,70.404888 C 63.670772,70.404888 66.61444,69.763508 70.077022,68.936138 L 70.077022,21.873638 C 66.61444,21.046268 63.670772,20.404888 60.077022,20.404888 z " style="fill:black;fill-opacity:1;fill-rule:evenodd;stroke:none;stroke-width:1px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1" id="path1307"/>
              <path class="band-2" d="M 75.077021,23.436138 L 75.077021,68.373638 C 77.833064,67.764415 81.056653,67.145981 85.077021,66.686138 L 85.077021,25.123638 C 81.056653,24.663795 77.833064,24.045361 75.077021,23.436138 z " style="fill:black;fill-opacity:1;fill-rule:evenodd;stroke:none;stroke-width:1px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1" id="path1309"/>
              <path class='band-3' d="M 90.077021,25.561138 L 90.077021,66.248638 C 93.012712,66.045115 96.309486,65.914842 100.07702,65.904888 L 100.07702,25.904888 C 96.309486,25.894934 93.012712,25.764661 90.077021,25.561138 z " style="fill:black;fill-opacity:1;stroke:none;stroke-width:1;stroke-linecap:square;stroke-miterlimit:4;stroke-dasharray:1, 1;stroke-dashoffset:0;stroke-opacity:1" id="rect2188"/>
              <path class='band-4' d="M 130.07702,22.498638 C 127.28962,23.167726 124.15989,23.922306 120.07702,24.561138 L 120.07702,67.248638 C 124.15989,67.88747 127.28962,68.64205 130.07702,69.311138 L 130.07702,22.498638 z " style="opacity:1;fill:black;fill-opacity:1;stroke:none;stroke-width:1;stroke-linecap:square;stroke-miterlimit:4;stroke-dasharray:1, 1;stroke-dashoffset:0;stroke-opacity:1" id="rect2190"/>
              <path d="M 25.577023,45.904888 C 25.577023,20.904888 50.577022,20.904888 60.577022,20.904888 C 70.577022,20.904888 75.577021,25.904888 100.57702,25.904888 C 125.57702,25.904888 130.57702,20.904888 140.57702,20.904888 C 150.57702,20.904888 175.57702,20.904888 175.57702,45.904888 C 175.57702,70.904888 150.57702,70.904888 140.57702,70.904888 C 130.57702,70.904888 125.57702,65.904888 100.57702,65.904888 C 75.577021,65.904888 70.577022,70.904888 60.577022,70.904888 C 50.577022,70.904888 25.778858,71.620488 25.577023,45.904888 z " style="fill:none;fill-opacity:0.75;fill-rule:evenodd;stroke:#000000;stroke-width:1px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1" id="path7450"/>
              <rect width="20.32258" height="10" x="5.4157324" y="40.904888" style="opacity:1;fill:#000000;fill-opacity:0.27160495;stroke:#000000;stroke-width:0.82305491;stroke-linecap:square;stroke-miterlimit:4;stroke-dasharray:0.82305488, 0.82305488;stroke-dashoffset:0;stroke-opacity:1" id="rect9208"/>
              <rect width="19.672131" height="10" x="175.40489" y="40.404888" style="opacity:1;fill:#000000;fill-opacity:0.27160495;stroke:#000000;stroke-width:0.80977631;stroke-linecap:square;stroke-miterlimit:4;stroke-dasharray:0.80977632, 0.80977632;stroke-dashoffset:0;stroke-opacity:1" id="rect10083"/>
              
              
              
              
            </g>
          </svg>
</div>

<h5 id="">Resistance Value: <span id="resistance-value"></span> Ohm</h5>
</div>
</div>

<script>
var colors = ['black','brown','red','orange','yellow','green','blue','violet','grey','white'];
var toleranceColors = ['gold','silver'];
var bandSelect = $('.band-select');
var toleranceSelect = $('.tolerance-select');
colors.forEach(color => {
    bandSelect.append('<option value='+color+'>'+color+'</option>');
});
toleranceColors.forEach(color =>{
  toleranceSelect.append('<option value='+color+'>'+color+'</option>')
} )
var band1 = band2 = band4 = resistorValue = "";
var band3 = 0;
function updateResistance(){
    band1 = colors.indexOf($('#select-band-1').val()+"");
    band2 = colors.indexOf($('#select-band-2').val()+"");
    band3 = colors.indexOf($('#select-band-3').val()+"");
    band4 = toleranceColors.indexOf($('#select-band-4').val()+"");
    $('.band-1').css('fill',$('#select-band-1').val());
    $('.band-2').css('fill',$('#select-band-2').val());
    $('.band-3').css('fill',$('#select-band-3').val());
    $('.band-4').css('fill',$('#select-band-4').val());
    resistorValue= band1+""+band2+"";
    for(let index=1;index<=band3;index++){
        resistorValue+="0";
    }
    if(band4==0){
      resistorValue+='  &plusmn;'+5+'%';
    }
    else if(band4==1){
      resistorValue+='  &plusmn;'+10+'%';
    }

    $('#resistance-value').html(resistorValue);
}

</script>
@endsection