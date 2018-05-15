<section class='equipInfo'>
    @if(isset($item->metaInfo->equip->reqSTR) || isset($item->metaInfo->equip->reqDEX) || isset($item->metaInfo->equip->reqINT) || isset($item->metaInfo->equip->reqLUK) || isset($item->metaInfo->equip->reqJob))
        <span class="badge badge-danger mr-1">Required:</span>

        @isset($item->metaInfo->equip->reqLevel)
            <span class="badge badge-success mr-1">Level {{ $item->metaInfo->equip->reqLevel }}</span>
        @endisset

        @isset($item->metaInfo->equip->reqSTR)
            <span class="badge badge-dark mr-1">{{ $item->metaInfo->equip->reqSTR }} STR</span>
        @endisset
        @isset($item->metaInfo->equip->reqDEX)
            <span class="badge badge-dark mr-1">{{ $item->metaInfo->equip->reqDEX }} DEX</span>
        @endisset
        @isset($item->metaInfo->equip->reqINT)
            <span class="badge badge-dark mr-1">{{ $item->metaInfo->equip->reqINT }} INT</span>
        @endisset
        @isset($item->metaInfo->equip->reqLUK)
            <span class="badge badge-dark mr-1">{{ $item->metaInfo->equip->reqLUK }} LUK</span>
        @endisset
        @isset($item->metaInfo->equip->reqPOP)
            <span class="badge badge-dark mr-1">{{ $item->metaInfo->equip->reqPOP }} Fame</span>
        @endisset

        @isset($item->metaInfo->equip->reqJob)
            <span class="badge badge-dark mr-1">
                Equippable by: {{ GetRequiredJobs($item->metaInfo->equip->reqJob) }}
                
                @isset($item->metaInfo->equip->reqJob2)
                    (Sub-class: {{ $item->metaInfo->equip->reqJob2 }} )
                @endisset

                @isset($item->metaInfo->equip->reqSpecJob)
                    (Special class: {{ $item->metaInfo->equip->reqSpecJob }} )
                @endisset
            </span>
        @endisset
        <br/>
        @isset($item->metaInfo->equip->tradeAvailable)
            <span class="text-warning mr-1">{{ GetTradeAvailable($item->metaInfo->equip->tradeAvailable) }}</span>
        @endisset
    @endif

    <ul class="list-unstyled mb-0">

    @isset($item->metaInfo->equip->exItem)
        <li>
            <b>{{ $item->metaInfo->equip->exItem == 1 ? '(Exclusive / Unique Item)' : '' }}</b>
        </li>
    @endisset

    @isset($item->metaInfo->equip->superiorEqp)
        <li style="color:yellow">
            <b>{{ $item->metaInfo->equip->superiorEqp == 1 ? 'Superior Equip' : '' }}</b>
        </li>
    @endisset

    <!-- STR/DEX/INT/LUK  -->
    @isset($item->metaInfo->equip->incSTR)
        <li>+ {{ $item->metaInfo->equip->incSTR }} STR</li>
    @endisset
    @isset($item->metaInfo->equip->incDEX)
        <li>+ {{ $item->metaInfo->equip->incDEX }} DEX</li>
    @endisset
    @isset($item->metaInfo->equip->incINT)
        <li>+ {{ $item->metaInfo->equip->incINT }} INT</li>
    @endisset
    @isset($item->metaInfo->equip->incLUK)
        <li>+ {{ $item->metaInfo->equip->incLUK }} LUK</li>
    @endisset

    <!-- HP / MP -->
    @isset($item->metaInfo->equip->incMHP)
        <li>+ {{ $item->metaInfo->equip->incMHP }} HP</li>
    @endisset
    @isset($item->metaInfo->equip->incMMP)
        <li>+ {{ $item->metaInfo->equip->incMMP }} MP</li>
    @endisset

    <!-- Attack / M. Attack -->
    @isset($item->metaInfo->equip->incPAD)
        <li>+ {{ $item->metaInfo->equip->incPAD }} Weapon Attack</li>
    @endisset
    @isset($item->metaInfo->equip->incMAD)
        <li>+ {{ $item->metaInfo->equip->incMAD }} Magic Attack</li>
    @endisset

    <!-- Etc -->
    @isset($item->metaInfo->equip->incPDD)
        <li>+ {{ $item->metaInfo->equip->incPDD }} Weapon Defense</li>
    @endisset
    @isset($item->metaInfo->equip->incMDD)
        <li>+ {{ $item->metaInfo->equip->incMDD }} Magic Defense</li>
    @endisset
    @isset($item->metaInfo->equip->incACC)
        <li>+ {{ $item->metaInfo->equip->incACC }} Accuracy</li>
    @endisset
    @isset($item->metaInfo->equip->incEVA)
        <li>+ {{ $item->metaInfo->equip->incEVA }} Avoidability</li>
    @endisset

    @isset($item->metaInfo->equip->incCraft)
        <li>+ {{ $item->metaInfo->equip->incCraft }} Craft</li>
    @endisset
    @isset($item->metaInfo->equip->incSpeed)
        <li>+ {{ $item->metaInfo->equip->incSpeed }} Speed</li>
    @endisset
    @isset($item->metaInfo->equip->incJump)
        <li>+ {{ $item->metaInfo->equip->incJump }} Jump</li>
    @endisset

    <!-- Traits -->
    @isset($item->metaInfo->equip->charmEXP)
        <li>+ {{ $item->metaInfo->equip->charmEXP }} Charm (Trait)</li>
    @endisset
    @isset($item->metaInfo->equip->willEXP)
        <li>+ {{ $item->metaInfo->equip->willEXP }} Willpower (Trait)</li>
    @endisset
    @isset($item->metaInfo->equip->charismaEXP)
        <li>+ {{ $item->metaInfo->equip->charismaEXP }} Charisma (Trait)</li>
    @endisset
    @isset($item->metaInfo->equip->craftEXP)
        <li>+ {{ $item->metaInfo->equip->craftEXP }} Diligence (Trait)</li>
    @endisset
    @isset($item->metaInfo->equip->senseEXP)
        <li>+ {{ $item->metaInfo->equip->senseEXP }} Insight (Trait)</li>
    @endisset

    @isset($item->metaInfo->equip->tuc)
        <br/>
        <li><b>This item can be scrolled {{ $item->metaInfo->equip->tuc }} times.</b></li>
    @endisset

    {{-- <!-- Tradable Status -->
    @isset($item->metaInfo->equip->tradeBlock)
        <li>Is this item tradable? {{ $item->metaInfo->equip->tradeBlock == 1 ? 'Yes' : 'No' }}</li> 
    @endisset
    @isset($item->metaInfo->equip->equipTradeBlock)
        <li>
            {{ $item->metaInfo->equip->equipTradeBlock == 1 ? 'This item can not be traded after being equipped.' : '' }}
        </li>
    @endisset --}}

    @isset($item->metaInfo->equip->noPotential)
            <tr>
                <td>The character can not put a potential on this item</td>
                <td>{{ $item->metaInfo->equip->noPotential == 1 ? 'true' : 'false' }}</td>
            </tr>
    @endisset
    @isset($item->metaInfo->equip->unchangeable)
            <tr>
                <td>The character can not change anything on this item</td>
                <td>{{ $item->metaInfo->equip->unchangeable == 1 ? 'true' : 'false' }}</td>
            </tr>
    @endisset
    @isset($item->metaInfo->equip->durability)
            <tr>
                <td>This item has a durability</td>
                <td>{{ $item->metaInfo->equip->durability == 1 ? 'true' : 'false' }}</td>
            </tr>
    @endisset
    @isset($item->metaInfo->equip->accountSharable)
        <li>{{ $item->metaInfo->equip->accountSharable == 1 ? 'It is possible to move this through storage to other characters.' : '' }}</li>
    @endisset
    @isset($item->metaInfo->equip->attackSpeed)
            <tr>
                <td>Attack Speed</td>
                <td>{{ $item->metaInfo->equip->attackSpeed }}</td>
            </tr>
    @endisset
    @isset($item->metaInfo->equip->bdR)
            <tr>
                <td>The boss damage this item gives</td>
                <td>{{ $item->metaInfo->equip->bdR }}%</td>
            </tr>
    @endisset
    @isset($item->metaInfo->equip->bossReward)
            <li><i>{{ $item->metaInfo->equip->bossReward == 1 ? 'This item is rewarded for fighting against a specific boss.' : '' }}</i></li>
    @endisset
    @isset($item->metaInfo->equip->imdR)
            <tr>
                <td>The ignore defense this item gives</td>
                <td>{{ $item->metaInfo->equip->imdR }}%</td>
            </tr>
    @endisset
    {{-- 
        These aren't actual stats we want to display on the item infoirmation.
        @isset($item->metaInfo->equip->islot)
            <tr>
                <td>Exclusive slot of item</td>
                <td>{{ $item->metaInfo->equip->islot }}</td>
            </tr>
    @endisset
    @isset($item->metaInfo->equip->vslot)
            <tr>
                <td>Visual Slots of item</td>
                <td>{{ $item->metaInfo->equip->vslot }}</td>
            </tr>
    @endisset --}}
    </ul>
</section>