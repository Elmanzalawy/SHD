@extends('layouts.app')

@section('content')
<style>
body{
    margin-top: 56px;
}
</style>

<div class="section-light">
    <div class="container">
        <h1 class="main-header center" style="margin-bottom:2rem;">{{$title}}</h1>
        <h5 class=" primary-color">Shabab Handaset Damietta is a student activity group consisting of students from NDETI. Our objectives are: </h5>
        <ul>
          <li>Providing academic assistance to students.</li>
          <li>Archiving lectures and previous exams.</li>
          <li>Managing student activity.</li>
          <li>Arranging events inside and outside the institute.</li>
          <li>Managing welcome and graduation parties.</li>
      </ul>
      <hr class="hr-blue">
      <h5 class=" primary-color">Shabab Handaset Damietta features 7 activity groups each having their own roles:</h5>
      <ol class="group-list">
          <li><span class="skyblue">Scientific SHD:</span> Provides academic assistance to students as well as archiving lectures and previous exams.</li>
          <li><span class="skyblue">Culture SHD: </span>Publishes articles about cultures around the world and manages related events.</li>
          <li><span class="skyblue">Artistry SHD: </span>Publishes articles about art and artists, supports students with artistic hobbies, hosts art workshops.</li>
          <li><span class="skyblue">Social SHD: </span>Hosts trips , charities and donations, and guides new members.</li>
          <li><span class="skyblue">Sports SHD: </span>Manages athletic activity and hosts sports events.</li>
          <li><span class="skyblue">Announcements &amp; Advertising: </span>Arranges advertisement campaigns, announces about events, gathers information through surveys.</li>
          <li><span class="skyblue">Suggestions &amp; Complaints: </span>Receives suggestions and complaints from SHD members and presents them anonymously to SHD head team.</li>
      </ol>
      <hr class="hr-blue">
      <p><span class="skyblue">&#42;</span> For more information please read the <a href="rules.2017-5-11.pdf" target="_blank">Rules</a> or <a href="#" class="contact-us" data-toggle="modal" data-target="#contact-us-modal">Contact Us</a>.</p>
    </div>
</div>
@endsection