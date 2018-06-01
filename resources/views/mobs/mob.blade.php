@extends('layouts.app')

@section('title', $mob->name)
@section('desc', 'Discover information, statistics, and much more about the monster '.$mob->name.'.')
@section('image', 'http://maplestory.io/api/gms/latest/mob/'.$mob->id.'/icon?resize=5')

@section('css')
<style>
table tr td:first-child {
    padding-right: 10px;
}

.drops li {
    display: flex;
    margin: 6px 0;
}

.drops li a {
    overflow: hidden;
    display: flex;
    align-items: center;
}

.drops img {
    margin-right: 8px;
    float: left;
    flex-shrink: 0;
}

.mobInfo {
    background: rgba(0,0,0,0.7);
    width: 100%;
    padding: 10px 20px;
    border-radius: 5px;
    color: #FFF;
}
</style>
@endsection

@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="/{{$region}}/{{$version}}/monsters/home">Monsters</a></li>
    <li class="breadcrumb-item active">{{ $mob->name }}</li>
</ol>
<header class="primaryInfo mb-4">
    <div class="row is-flex">
        <div class="col-md-6">
            <div class='itemName title'>
                <span class="name display-4">
                    {{ $mob->name }}<br/>
                </span>
                @isset($mob->meta->isBoss)
                    @if($mob->meta->isBoss == 1)
                        <span class="badge bg-dark text-white font-weight-normal">Boss</span>
                    @endif
                @endisset
                @isset($mob->meta->level)
                    <span class="badge bg-white border border-dark font-weight-normal">Level {{$mob->meta->level}}</span>
                @endisset
                @isset($mob->meta->exp)
                    <span class="badge bg-white border border-dark font-weight-normal">{{ number_format($mob->meta->exp) }} Exp</span>
                @endisset
            </div>
            <ul class="list-group mt-4">
                @isset($mob->meta->maxHP)
                    <li class="list-group-item d-flex justify-content-between align-items-center lead text-danger">
                        Health
                        <span class="badge badge-danger p-2">{{ number_format($mob->meta->maxHP) }}</span>
                    </li>
                @endisset
                @isset($mob->meta->maxMP)
                    <li class="list-group-item d-flex justify-content-between align-items-center lead text-primary">
                        Mana
                        <span class="badge badge-primary p-2">{{ number_format($mob->meta->maxMP) }}</span>
                    </li>
                @endisset
                @isset($mob->meta->accuracy)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Accuracy
                        <span>{{$mob->meta->accuracy}}</span>
                    </li>
                @endisset
                @isset($mob->meta->evasion)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Evasion
                        <span>{{$mob->meta->evasion}}</span>
                    </li>
                @endisset
                @isset($mob->meta->speed)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Speed
                        <span>{{$mob->meta->speed}}</span>
                    </li>
                @endisset
                @isset($mob->meta->flySpeed)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Flying Speed
                        <span>{{$mob->meta->flySpeed}}</span>
                    </li>
                @endisset
            </ul>

            <div class="card-deck mb-2 mt-4">
                @isset($mob->meta->physicalDefense)
                    <div class="card border border-primary text-primary">
                        <div class="card-body">
                            <h5 class="card-title">Physical</h5>
                            <i class="fal fa-shield fa-fw"></i> {{ number_format($mob->meta->physicalDefense) }}</span> Defense<br/>
                            @isset($mob->meta->physicalDamage)
                                <p><i class="fal fa-feather fa-fw"></i> {{ number_format($mob->meta->physicalDamage) }} Attack</p>
                            @endisset
                            @isset($mob->meta->physicalDefenseRate)
                                {{$mob->meta->physicalDefenseRate}}% Damage Resistance (PDR)
                            @endisset
                        </div>
                    </div>
                @endisset
                @isset($mob->meta->magicDefense)
                    <div class="card border border-success text-success">
                        <div class="card-body">
                            <h5 class="card-title">Magic</h5>
                            <i class="fal fa-shield fa-fw"></i> {{ number_format($mob->meta->magicDefense) }} Defense</span><br/>
                            @isset($mob->meta->magicDamage)
                                <p><i class="fal fa-feather fa-fw"></i> {{ number_format($mob->meta->magicDamage) }} Magic Attack</p>
                            @endisset
                            @isset($mob->meta->magicDefenseRate)
                                {{$mob->meta->magicDefenseRate}}% Damage Resistance (MDR)
                            @endisset
                        </div>
                    </div>
                @endisset
            </div>
        </div>
        <div class="col-md-6">
            <img src='http://maplestory.io/api/gms/latest/mob/{{ $mob->id }}/icon?resize=5' style="margin:auto;max-width:100%;image-rendering: pixelated;" class=""/>
        </div>
    </div>
</header>

@isset($mob->meta->elementalAttributes)
<p class="lead">
    @foreach(explode('-', trim(chunk_split(trim($mob->meta->elementalAttributes), 2, '-'), '-')) as $elemental)

    @php
        $elementalChar = substr($elemental, 0, 1);
        $elementalName = $elemental;
        switch($elementalChar) {
            case 'H': $elementalName = 'Holy'; break;
            case 'P': $elementalName = 'Poison'; break;
            case 'F': $elementalName = 'Fire'; break;
            case 'I': $elementalName = 'Ice'; break;
            case 'L': $elementalName = 'Lightning'; break;
            case 'D': $elementalName = 'Dark'; break;
            case 'S': $elementalName = 'Physical'; break;
        }

        $elementalAttribute = substr($elemental, 1, 1);
        switch($elementalAttribute) {
            case '1': $elementalAttributeModifier = 'Immune'; break;
            case '2': $elementalAttributeModifier = 'Strong'; break;
            case '3': $elementalAttributeModifier = 'Weak'; break;
            default: $elementalAttributeModifier = 'Neutral'; break;
        }
    @endphp

    <span class="badge bg-white border border-primary text-primary font-weight-normal"><b>{{$elementalAttributeModifier}}</b> against <b>{{$elementalName}}</b></span>
    @endforeach
</p>
@endisset

<div class='mobInfo'>
    <ul class="list-unstyled m-0">
        <li class="font-weight-bold text-warning">Additional Information</li>
        @isset($mob->meta->isUndead)
            <li><span class="mr-2 font-weight-bold">Is undead: {{$mob->meta->isUndead == 1 ? 'True' : 'False'}}</span></li>
        @endisset
        @isset($mob->meta->minimumPushDamage)
            <li><span class="mr-2 font-weight-bold">Min damage to knockback: {{ number_format($mob->meta->minimumPushDamage) }}</span></li>
        @endisset
        @isset($mob->meta->hpRecovery)
            <li><span class="mr-2 font-weight-bold">HP recovered: {{ number_format($mob->meta->hpRecovery) }}</span></li>
        @endisset
        @isset($mob->meta->mpRecovery)
            <li><span class="mr-2 font-weight-bold">MP recovered: {{ number_format($mob->meta->mpRecovery) }}</span></li>
        @endisset
        @isset($mob->meta->noRespawn)
            <li><span class="mr-2 font-weight-bold">Will respawn upon death</span><span class="mr-2">{{$mob->meta->noRespawn}}</span></li>
        @endisset
        @isset($mob->meta->linksToOtherMob)
            <li><td colspan='2'><a href='/{{$region}}/{{$version}}/monster/{{$mob->meta->linksToOtherMob}}/{{ str_slug($mob->name) }}'>Mimics other mob</a></span></li>
        @endisset
        @isset($mob->meta->onlyNormalAttack)
            <li><span class="mr-2 font-weight-bold">Only normal attacks</span><span class="mr-2">{{$mob->meta->onlyNormalAttack}}</span></li>
        @endisset
        @isset($mob->meta->fixedDamageAmount)
            <li><span class="mr-2 font-weight-bold">Damage per line</span><span class="mr-2">{{$mob->meta->fixedDamageAmount}}</span></li>
        @endisset
        @isset($mob->meta->isAutoAggro)
            <li><span class="mr-2 font-weight-bold">Auto aggro: {{$mob->meta->isAutoAggro == 1 ? 'True' : 'False'}}</span></li>
        @endisset
        @isset($mob->meta->publicReward)
            <li><span class="mr-2 font-weight-bold">Item drops are public</span><span class="mr-2">{{$mob->meta->publicReward}}</span></li>
        @endisset
        @isset($mob->meta->explosiveReward)
            <li><span class="mr-2 font-weight-bold">Explosive drops</span><span class="mr-2">{{$mob->meta->explosiveReward}}</span></li>
        @endisset
        @isset($mob->meta->isInvincible)
            <li><span class="mr-2 font-weight-bold">Is invincible</span><span class="mr-2">{{$mob->meta->isInvincible == 1 ? 'True' : 'False'}}</span></li>
        @endisset
        @isset($mob->meta->noAttack)
            <li><span class="mr-2 font-weight-bold">Monster can not attack you but you can attack it</span><span class="mr-2">{{$mob->meta->noAttack}}</span></li>
        @endisset
        @isset($mob->meta->removeAfterTime)
            <li><span class="mr-2 font-weight-bold">Despawns after</span><span class="mr-2">{{$mob->meta->removeAfterTime}}</span></li>
        @endisset
        @isset($mob->meta->buffId)
            <li><span class="mr-2 font-weight-bold">Buff given when killed</span><span class="mr-2">{{$mob->meta->buffId}}</span></li>
        @endisset
        @isset($mob->meta->hideName)
            <li><span class="mr-2 font-weight-bold">Hides the name</span><span class="mr-2">{{$mob->meta->hideName}}</span></li>
        @endisset
        @isset($mob->meta->monsterBookId)
            <li><span class="mr-2 font-weight-bold">Monster book ID</span><span class="mr-2">{{$mob->meta->monsterBookId}}</span></li>
        @endisset
    </ul>
</div>

<a class="btn btn-soft btn-sm mt-3" href="//maplestory.io/api/{{$region}}/{{$version}}/mob/{{$mob->id}}" target="_blank">
    <i class="fal fa-code"></i> View API Request
</a>
    <div class="row mt-3">
        @if(count($mob->foundAt) > 0)
            <div class="col-md-4">
                <span class="lead">Located at</span>
                <section class='foundAt' class="list-group">
                    @foreach($mob->foundAt as $mapEntry)
                        <a href='/{{$region}}/{{$version}}/map/{{$mapEntry->id}}' class='list-group-item list-group-item-action'>{{$mapEntry->name}} ({{$mapEntry->streetName}})</a>
                    @endforeach
                    </ul>
                </section>
            </div>
        @endif

        @if(isset($mob->drops) && count($mob->drops) > 0)
            <div class="col-md-4">
                <span class="lead">Drops <span class="badge badge-info">Not 100% Accurate</span></span>
                <section class='drops' class="list-group">
                    @foreach($mob->drops as $drop)
                        <a href='/{{$region}}/{{$version}}/item/{{$drop->id}}' class='list-group-item list-group-item-action'><img src='https://labs.maplestory.io/api/{{$region}}/{{$version}}/item/{{$drop->id}}/icon' />{{$drop->name}}</a>
                    @endforeach
                </section>
            </div>
        @endif

            <div class="col-md-4">
                <span class="lead">Preview</span>
                <div class='previewControls mt-4'>
                    <img src="https://labs.maplestory.io/api/{{$region}}/{{$version}}/mob/{{$mob->id}}/render/{{array_keys(get_object_vars($mob->framebooks))[0]}}" appendFramebook="https://labs.maplestory.io/api/{{$region}}/{{$version}}/mob/{{$mob->id}}/render" />
                    {{-- Uglify the framebooks so they can presented to the user in a reasonable and consumeable manner --}}
                    <div class='previewController mt-3'>
                    <select class='framebookSelector'>
                    @foreach($mob->framebooks as $animation => $frames)
                        <option value='{{$animation}}'>{{$animation}}</option>
                    @endforeach
                    </select>
                    </div>
                </div>

                @foreach($mob->framebooks as $animation => $frames)
                    <div class='framebook' id='{{$animation}}' style='display: none;'>
                        <select class='frameSelector' style='display: none;' for='{{$animation}}'>
                        @for($frameNumber = 0; $frameNumber < $frames; ++$frameNumber)
                            <option value='{{$frameNumber}}'>Frame {{$frameNumber}}</option>
                        @endfor
                        </select>
                    </div>
                @endforeach
            </div>
    </div>
@endsection

@section('js')
<script>
    $(function() {
        $('.framebookSelector').change(function(){
            $('.framebook, .frame').hide()
            $('#' + $(this).val() + ', ' + '#' + $(this).val() + ' .frame:first').show()

            var shouldAppendFramebook = $("img[appendFramebook]")
            if (shouldAppendFramebook)
                shouldAppendFramebook.attr('src', shouldAppendFramebook.attr('appendFramebook') + '/' + $(this).val())

            var frameSelector = $($('#' + $(this).val() + ' .frameSelector')[0].outerHTML)
            copyAndShowFrameSelector(frameSelector)
        })

        $('.framebook:first, .frame:first').show()
        copyAndShowFrameSelector($('.framebook:first .frameSelector'))
    })

    function copyAndShowFrameSelector($frameSelector) {
        $frameSelector.show().change(function(){
            $('.frame').hide()
            $('.frame-' + $(this).val()).show()
            var frameBook = $('.framebookSelector').val()

            var shouldAppendFramebook = $("img[appendFramebook]")
            if (shouldAppendFramebook)
                shouldAppendFramebook.attr('src', shouldAppendFramebook.attr('appendFramebook') + '/' + frameBook + '/' + $(this).val())
        });

        $('.previewController .frameSelector').remove()
        $('.previewController').append($frameSelector)
    }
</script>
@endsection