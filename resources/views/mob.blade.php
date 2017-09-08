@extends('layouts.app')

@section('content')
<header class="primaryInfo">
    <b>Mob</b>
    <div class='itemName title'>
        <span class="name">{{ $mob->name }}</span><br/>
        @isset($mob->description)
        <span class='desc'>{!! nl2br(str_replace(array('\r', '\n'), array("\r", "\n"), $mob->description)) !!}</span>
        @endisset
        </div>
</header>

<div>
    <section>
        <div class='title'>Info</div>
        <table>
    @isset($mob->meta->isBodyAttack)
        <tr><td>Can physical attack you</td><td>{{$mob->meta->isBodyAttack == 1 ? 'True' : 'False'}}</td></tr>
    @endisset
    @isset($mob->meta->level)
        <tr><td>Level.</td><td>{{$mob->meta->level}}</td></tr>
    @endisset
    @isset($mob->meta->maxHp)
        <tr><td>Max HP</td><td>{{$mob->meta->maxHp}}</td></tr>
    @endisset
    @isset($mob->meta->maxMp)
        <tr><td>Max MP</td><td>{{$mob->meta->maxMp}}</td></tr>
    @endisset
    @isset($mob->meta->speed)
        <tr><td>Movement speed</td><td>{{$mob->meta->speed}}</td></tr>
    @endisset
    @isset($mob->meta->flySpeed)
        <tr><td>Flying speed</td><td>{{$mob->meta->flySpeed}}</td></tr>
    @endisset
    @isset($mob->meta->physicalDamage)
        <tr><td>Physical attack damage</td><td>{{$mob->meta->physicalDamage}}</td></tr>
    @endisset
    @isset($mob->meta->physicalDefense)
        <tr><td>Physical defense</td><td>{{$mob->meta->physicalDefense}}</td></tr>
    @endisset
    @isset($mob->meta->magicDamage)
        <tr><td>Magical Attack Damage</td><td>{{$mob->meta->magicDamage}}</td></tr>
    @endisset
    @isset($mob->meta->magicDefense)
        <tr><td>Magical Attack Defense</td><td>{{$mob->meta->magicDefense}}</td></tr>
    @endisset
    @isset($mob->meta->accuracy)
        <tr><td>Accuracy</td><td>{{$mob->meta->accuracy}}</td></tr>
    @endisset
    @isset($mob->meta->evasion)
        <tr><td>Evasion</td><td>{{$mob->meta->evasion}}</td></tr>
    @endisset
    @isset($mob->meta->exp)
        <tr><td>Experience</td><td>{{$mob->meta->exp}}</td></tr>
    @endisset
    @isset($mob->meta->isUndead)
        <tr><td>Is undead</td><td>{{$mob->meta->isUndead == 1 ? 'True' : 'False'}}</td></tr>
    @endisset
    @isset($mob->meta->minimumPushDamage)
        <tr><td>Min damage to knockback</td><td>{{$mob->meta->minimumPushDamage}}</td></tr>
    @endisset
    @isset($mob->meta->hpRecovery)
        <tr><td>HP recovered</td><td>{{$mob->meta->hpRecovery}}</td></tr>
    @endisset
    @isset($mob->meta->mpRecovery)
        <tr><td>MP recovered</td><td>{{$mob->meta->mpRecovery}}</td></tr>
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

        <tr><td>
            {{$elementalAttributeModifier}} against
        </td><td>
            {{$elementalName}}
        </td></tr>
        @endforeach
    @endisset
    @isset($mob->meta->summonType)
        <tr><td>Summons other monsters</td><td>{{$mob->meta->summonType}}</td></tr>
    @endisset
    @isset($mob->meta->hpTagColor)
        <tr><td>HP gauge Tag</td><td>{{$mob->meta->hpTagColor}}</td></tr>
    @endisset
    @isset($mob->meta->hpTagBackgroundColor)
        <tr><td>HP gauge Tag background</td><td>{{$mob->meta->hpTagBackgroundColor}}</td></tr>
    @endisset
    @isset($mob->meta->hpGaugeHide)
        <tr><td>HP gauge should be hidden</td><td>{{$mob->meta->hpGaugeHide}}</td></tr>
    @endisset
    @isset($mob->meta->noRespawn)
        <tr><td>Will respawn upon death</td><td>{{$mob->meta->noRespawn}}</td></tr>
    @endisset
    @isset($mob->meta->revivesMonsterId)
        <tr><td>Spawn these mobs after death</td><td><ul>{!! implode(array_map(function ($mob) { return '<li><a href=\'/mob/'.$mob->id.'\'>'.$mob->name.'</a></li>'; }, $mob->meta->revivesMonsterId),'') !!}</ul></td></tr>
    @endisset
    @isset($mob->meta->linksToOtherMob)
        <tr><td colspan='2'><a href='/mob/{{$mob->meta->linksToOtherMob}}'>Mimics other mob</a></td></tr>
    @endisset
    @isset($mob->meta->onlyNormalAttack)
        <tr><td>Only normal attacks</td><td>{{$mob->meta->onlyNormalAttack}}</td></tr>
    @endisset
    @isset($mob->meta->fixedDamageAmount)
        <tr><td>Damage per line</td><td>{{$mob->meta->fixedDamageAmount}}</td></tr>
    @endisset
    @isset($mob->meta->isBoss)
        <tr><td>Is a boss</td><td>{{$mob->meta->isBoss == 1 ? 'True' : 'False'}}</td></tr>
    @endisset
    @isset($mob->meta->isAutoAggro)
        <tr><td>Auto aggro</td><td>{{$mob->meta->isAutoAggro == 1 ? 'True' : 'False'}}</td></tr>
    @endisset
    @isset($mob->meta->publicReward)
        <tr><td>Item drops are public</td><td>{{$mob->meta->publicReward}}</td></tr>
    @endisset
    @isset($mob->meta->explosiveReward)
        <tr><td>Explosive drops</td><td>{{$mob->meta->explosiveReward}}</td></tr>
    @endisset
    @isset($mob->meta->isInvincible)
        <tr><td>Is invincible</td><td>{{$mob->meta->isInvincible == 1 ? 'True' : 'False'}}</td></tr>
    @endisset
    @isset($mob->meta->noAttack)
        <tr><td>Monster can not attack you but you can attack it</td><td>{{$mob->meta->noAttack}}</td></tr>
    @endisset
    @isset($mob->meta->removeAfterTime)
        <tr><td>Despawns after</td><td>{{$mob->meta->removeAfterTime}}</td></tr>
    @endisset
    @isset($mob->meta->buffId)
        <tr><td>Buff given when killed</td><td>{{$mob->meta->buffId}}</td></tr>
    @endisset
    @isset($mob->meta->hideName)
        <tr><td>Hides the name</td><td>{{$mob->meta->hideName}}</td></tr>
    @endisset
    @isset($mob->meta->monsterBookId)
        <tr><td>Monster book ID</td><td>{{$mob->meta->monsterBookId}}</td></tr>
    @endisset
    @isset($mob->meta->physicalDefenseRate)
        <tr><td>PDR</td><td>{{$mob->meta->physicalDefenseRate}}</td></tr>
    @endisset
    @isset($mob->meta->magicDefenseRate)
        <tr><td>MDR</td><td>{{$mob->meta->magicDefenseRate}}</td></tr>
    @endisset
        </table>
    </section>

    <section class='preview'>
        <div class='title'><b>Preview</b></div>

        <div>
            <div class='previewControls'>
                <img src="https://labs.maplestory.io/api/gms/latest/mob/{{$mob->id}}/render/{{array_keys(get_object_vars($mob->framebooks))[0]}}" appendFramebook="https://labs.maplestory.io/api/gms/latest/mob/{{$mob->id}}/render" />
                {{-- Uglify the framebooks so they can presented to the user in a reasonable and consumeable manner --}}
                <div class='previewController'>
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
    </section>

    @if(count($mob->foundAt) > 0)
    <section class='foundAt'>
        <div class='title'>Found at</div>
        <ul>
        @foreach($mob->foundAt as $mapEntry)
            <li><a href='/map/{{$mapEntry->id}}'>{{$mapEntry->name}} ({{$mapEntry->streetName}})</a></li>
        @endforeach
        </ul>
    </section>
    @endif

    @if(isset($mob->drops) && count($mob->drops) > 0)
    <section class='drops'>
        <b class='title'>Drops</b>
        <ul>
        @foreach($mob->drops as $drop)
            <li><a href='/item/{{$drop->id}}'><img src='https://labs.maplestory.io/api/gms/latest/item/{{$drop->id}}/icon' />{{$drop->name}}</a></li>
        @endforeach
        </ul>
    </section>
    @endif
</div>

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
<style>
table tr td:first-child {
    text-align: right;
    padding-right: 5px;
}

section, header {
    display: inline-flex;
    flex-direction: column;
}

section {
    align-items: center;
    padding: 0 16px;
}

.previewController {
    display: flex;
    justify-content: space-around;
}

.preview {
    float: right;
}

.foundAt, .drops {
    max-width: 397px;
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
</style>
@endsection