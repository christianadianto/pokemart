@extends('master')

@section('content_here')
<div class="col-5 pt-4">
    <div class="container breadcrumb text-danger">
        <h4>Welcome to PokeMart, {{date('D-d M Y ')}}</h4>
        <img src="{{asset('assets/logo.png')}}" width="220" alt="">
        <p class="text-left breadcrumb-font-size">
            We're glad you're here! We're striving to be the best resource about the Pokémon World on the net, so we cover all aspects of Nintendo's smash hit. Whatever knowledge you have—whether it's about the anime, card game, video game or movies—everything is welcome here. Just sign up for a totally free account and start contributing today! If you run into problems, be sure to give one of our admins a shout! Oh, and don't forget to visit our guidelines and Manual of Style to get some tips on the best ways you can help us grow this database!
            The Pokédex section has a wealth of information on all the Pokémon creatures from the entire game series. On the main list pages you can see the various stats of each Pokémon. Click a Pokémon's name to see a detailed page with Pokédex data, descriptions from previous games, sprites, evolutions, moves and more!
        </p>
    </div>
</div>
@stop