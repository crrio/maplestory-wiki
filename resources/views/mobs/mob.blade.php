@extends('layouts.app')

@section('title')
    {{$mob->name}}
@endsection

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
    <li class="breadcrumb-item"><a href="/{{$region}}/{{$version}}/mobs">Mobs</a></li>
    <li class="breadcrumb-item active">{{ $mob->name }}</li>
</ol>
<header class="primaryInfo">
    <div class='itemName title'>
            <img src='http://maplestory.io/api/gms/latest/mob/{{ $mob->id }}/icon?resize=3' style="max-width:250px;image-rendering: pixelated;margin:20px;float:right;display:block;z-index:1999;" class=" d-none d-lg-block"/>
        <span class="name display-4">{{ $mob->name }}</span><br/>
        @isset($mob->meta->level)
            <span class="badge badge-primary font-weight-normal">Level {{$mob->meta->level}}</span>
        @endisset
        @isset($mob->meta->exp)
            <span class="badge badge-success font-weight-normal">{{ number_format($mob->meta->exp) }} Exp</span>
        @endisset
    </div>
</header>

<div class='mobInfo'>
    <ul class="list-unstyled">
        @isset($mob->meta->isBodyAttack)
            <li><td>Can physical attack you</td><td>{{$mob->meta->isBodyAttack == 1 ? 'True' : 'False'}}</td></li>
        @endisset
        @isset($mob->meta->maxHp)
            <li><td>Max HP</td><td>{{$mob->meta->maxHp}}</td></li>
        @endisset
        @isset($mob->meta->maxMp)
            <li><td>Max MP</td><td>{{$mob->meta->maxMp}}</td></li>
        @endisset
        @isset($mob->meta->speed)
            <li><td>Movement speed</td><td>{{$mob->meta->speed}}</td></li>
        @endisset
        @isset($mob->meta->flySpeed)
            <li><td>Flying speed</td><td>{{$mob->meta->flySpeed}}</td></li>
        @endisset
        @isset($mob->meta->physicalDamage)
            <li><td>Physical attack damage</td><td>{{$mob->meta->physicalDamage}}</td></li>
        @endisset
        @isset($mob->meta->physicalDefense)
            <li><td>Physical defense</td><td>{{$mob->meta->physicalDefense}}</td></li>
        @endisset
        @isset($mob->meta->magicDamage)
            <li><td>Magical Attack Damage</td><td>{{$mob->meta->magicDamage}}</td></li>
        @endisset
        @isset($mob->meta->magicDefense)
            <li><td>Magical Attack Defense</td><td>{{$mob->meta->magicDefense}}</td></li>
        @endisset
        @isset($mob->meta->accuracy)
            <li><td>Accuracy</td><td>{{$mob->meta->accuracy}}</td></li>
        @endisset
        @isset($mob->meta->evasion)
            <li><td>Evasion</td><td>{{$mob->meta->evasion}}</td></li>
        @endisset
        @isset($mob->meta->isUndead)
            <li><td>Is undead</td><td>{{$mob->meta->isUndead == 1 ? 'True' : 'False'}}</td></li>
        @endisset
        @isset($mob->meta->minimumPushDamage)
            <li><td>Min damage to knockback</td><td>{{$mob->meta->minimumPushDamage}}</td></li>
        @endisset
        @isset($mob->meta->hpRecovery)
            <li><td>HP recovered</td><td>{{$mob->meta->hpRecovery}}</td></li>
        @endisset
        @isset($mob->meta->mpRecovery)
            <li><td>MP recovered</td><td>{{$mob->meta->mpRecovery}}</td></li>
        @endisset
        @isset($mob->meta->elementalAttributes)
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

            <li><td>
                {{$elementalAttributeModifier}} against
            </td><td>
                {{$elementalName}}
            </td></li>
            @endforeach
        @endisset
        @isset($mob->meta->summonType)
            <li><td>Summons other monsters</td><td>{{$mob->meta->summonType}}</td></li>
        @endisset
        @isset($mob->meta->hpTagColor)
            <li><td>HP gauge Tag</td><td>{{$mob->meta->hpTagColor}}</td></li>
        @endisset
        @isset($mob->meta->hpTagBackgroundColor)
            <li><td>HP gauge Tag background</td><td>{{$mob->meta->hpTagBackgroundColor}}</td></li>
        @endisset
        @isset($mob->meta->hpGaugeHide)
            <li><td>HP gauge should be hidden</td><td>{{$mob->meta->hpGaugeHide}}</td></li>
        @endisset
        @isset($mob->meta->noRespawn)
            <li><td>Will respawn upon death</td><td>{{$mob->meta->noRespawn}}</td></li>
        @endisset
        @isset($mob->meta->revivesMonsterId)
            <li><td>Spawn these mobs after death</td><td><ul>{!! implode(array_map(function ($mob) { return '<li><a href=\'/mob/'.$mob->id.'\'>'.$mob->name.'</a></li>'; }, $mob->meta->revivesMonsterId),'') !!}</ul></td></li>
        @endisset
        @isset($mob->meta->linksToOtherMob)
            <li><td colspan='2'><a href='/{{$region}}/{{$version}}/mob/{{$mob->meta->linksToOtherMob}}'>Mimics other mob</a></td></li>
        @endisset
        @isset($mob->meta->onlyNormalAttack)
            <li><td>Only normal attacks</td><td>{{$mob->meta->onlyNormalAttack}}</td></li>
        @endisset
        @isset($mob->meta->fixedDamageAmount)
            <li><td>Damage per line</td><td>{{$mob->meta->fixedDamageAmount}}</td></li>
        @endisset
        @isset($mob->meta->isBoss)
            <li><td>Is a boss</td><td>{{$mob->meta->isBoss == 1 ? 'True' : 'False'}}</td></li>
        @endisset
        @isset($mob->meta->isAutoAggro)
            <li><td>Auto aggro</td><td>{{$mob->meta->isAutoAggro == 1 ? 'True' : 'False'}}</td></li>
        @endisset
        @isset($mob->meta->publicReward)
            <li><td>Item drops are public</td><td>{{$mob->meta->publicReward}}</td></li>
        @endisset
        @isset($mob->meta->explosiveReward)
            <li><td>Explosive drops</td><td>{{$mob->meta->explosiveReward}}</td></li>
        @endisset
        @isset($mob->meta->isInvincible)
            <li><td>Is invincible</td><td>{{$mob->meta->isInvincible == 1 ? 'True' : 'False'}}</td></li>
        @endisset
        @isset($mob->meta->noAttack)
            <li><td>Monster can not attack you but you can attack it</td><td>{{$mob->meta->noAttack}}</td></li>
        @endisset
        @isset($mob->meta->removeAfterTime)
            <li><td>Despawns after</td><td>{{$mob->meta->removeAfterTime}}</td></li>
        @endisset
        @isset($mob->meta->buffId)
            <li><td>Buff given when killed</td><td>{{$mob->meta->buffId}}</td></li>
        @endisset
        @isset($mob->meta->hideName)
            <li><td>Hides the name</td><td>{{$mob->meta->hideName}}</td></li>
        @endisset
        @isset($mob->meta->monsterBookId)
            <li><td>Monster book ID</td><td>{{$mob->meta->monsterBookId}}</td></li>
        @endisset
        @isset($mob->meta->physicalDefenseRate)
            <li><td>PDR</td><td>{{$mob->meta->physicalDefenseRate}}</td></li>
        @endisset
        @isset($mob->meta->magicDefenseRate)
            <li><td>MDR</td><td>{{$mob->meta->magicDefenseRate}}</td></li>
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