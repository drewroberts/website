<style>
    .logo .center{
        animation-name: transformer;
        animation-duration: 25s;
        animation-delay: 5s;
        animation-iteration-count: 7;
        animation-timing-function: ease-in-out;
    }
    @keyframes transformer {
        0%   {width: 152px; background-color: black;}
        14%  {width: 152px; background-color: black;}
        15%  {width: 152px; background-color: white;}
        17%  {width: 0px; background-color: white;}
        93%  {width: 0px; background-color: white;}
        95%  {width: 152px; background-color: white;}
        96%  {width: 152px; background-color: black;}
        100% {width: 152px; background-color: black;}
    }
</style>