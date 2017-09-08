<section class='equipInfo'>
    <b>Equipment Information</b>
    <table>
@isset($item->metaInfo->equip->reqSTR)
        <tr>
            <td>Requires this STR</td>
            <td>{{ $item->metaInfo->equip->reqSTR }}</td>
        </tr>
@endisset
@isset($item->metaInfo->equip->reqDEX)
        <tr>
            <td>Requires this DEX</td>
            <td>{{ $item->metaInfo->equip->reqDEX }}</td>
        </tr>
@endisset
@isset($item->metaInfo->equip->reqINT)
        <tr>
            <td>Requires this INT</td>
            <td>{{ $item->metaInfo->equip->reqINT }}</td>
        </tr>
@endisset
@isset($item->metaInfo->equip->reqLUK)
        <tr>
            <td>Requires this LUK</td>
            <td>{{ $item->metaInfo->equip->reqLUK }}</td>
        </tr>
@endisset
@isset($item->metaInfo->equip->reqPOP)
        <tr>
            <td>Requires this fame</td>
            <td>{{ $item->metaInfo->equip->reqPOP }}</td>
        </tr>
@endisset
@isset($item->metaInfo->equip->reqJob)
        <tr>
            <td>Requires this job</td>
            <td>{{ GetRequiredJobs($item->metaInfo->equip->reqJob) }}</td>
        </tr>
@endisset
@isset($item->metaInfo->equip->reqJob2)
        <tr>
            <td>Requires this secondary job</td>
            <td>{{ $item->metaInfo->equip->reqJob2 }}</td>
        </tr>
@endisset
@isset($item->metaInfo->equip->reqSpecJob)
        <tr>
            <td>Requires this special job</td>
            <td>{{ $item->metaInfo->equip->reqSpecJob }}</td>
        </tr>
@endisset
@isset($item->metaInfo->equip->reqLevel)
        <tr>
            <td>Requires this level</td>
            <td>{{ $item->metaInfo->equip->reqLevel }}</td>
        </tr>
@endisset
@isset($item->metaInfo->equip->tuc)
        <tr>
            <td>Scrollable Count</td>
            <td>{{ $item->metaInfo->equip->tuc }}</td>
        </tr>
@endisset
@isset($item->metaInfo->equip->incSTR)
        <tr>
            <td>Increases STR by</td>
            <td>{{ $item->metaInfo->equip->incSTR }}</td>
        </tr>
@endisset
@isset($item->metaInfo->equip->incDEX)
        <tr>
            <td>Increases DEX by</td>
            <td>{{ $item->metaInfo->equip->incDEX }}</td>
        </tr>
@endisset
@isset($item->metaInfo->equip->incINT)
        <tr>
            <td>Increases INT by</td>
            <td>{{ $item->metaInfo->equip->incINT }}</td>
        </tr>
@endisset
@isset($item->metaInfo->equip->incLUK)
        <tr>
            <td>Increases LUK by</td>
            <td>{{ $item->metaInfo->equip->incLUK }}</td>
        </tr>
@endisset
@isset($item->metaInfo->equip->incMHP)
        <tr>
            <td>Increases Max HP by</td>
            <td>{{ $item->metaInfo->equip->incMHP }}</td>
        </tr>
@endisset
@isset($item->metaInfo->equip->incMMP)
        <tr>
            <td>Increases Max MP by</td>
            <td>{{ $item->metaInfo->equip->incMMP }}</td>
        </tr>
@endisset
@isset($item->metaInfo->equip->incPAD)
        <tr>
            <td>Increases Weapon ATT by</td>
            <td>{{ $item->metaInfo->equip->incPAD }}</td>
        </tr>
@endisset
@isset($item->metaInfo->equip->incMAD)
        <tr>
            <td>Increases Magic ATT by</td>
            <td>{{ $item->metaInfo->equip->incMAD }}</td>
        </tr>
@endisset
@isset($item->metaInfo->equip->incPDD)
        <tr>
            <td>Increases Weapon DEF by</td>
            <td>{{ $item->metaInfo->equip->incPDD }}</td>
        </tr>
@endisset
@isset($item->metaInfo->equip->incMDD)
        <tr>
            <td>Increases Magic DEF by</td>
            <td>{{ $item->metaInfo->equip->incMDD }}</td>
        </tr>
@endisset
@isset($item->metaInfo->equip->incACC)
        <tr>
            <td>Increases ACC by</td>
            <td>{{ $item->metaInfo->equip->incACC }}</td>
        </tr>
@endisset
@isset($item->metaInfo->equip->incEVA)
        <tr>
            <td>Increases EVA by</td>
            <td>{{ $item->metaInfo->equip->incEVA }}</td>
        </tr>
@endisset
@isset($item->metaInfo->equip->incCraft)
        <tr>
            <td>Increases Craft by</td>
            <td>{{ $item->metaInfo->equip->incCraft }}</td>
        </tr>
@endisset
@isset($item->metaInfo->equip->incSpeed)
        <tr>
            <td>Increases Speed by</td>
            <td>{{ $item->metaInfo->equip->incSpeed }}</td>
        </tr>
@endisset
@isset($item->metaInfo->equip->incJump)
        <tr>
            <td>Increases Jump by</td>
            <td>{{ $item->metaInfo->equip->incJump }}</td>
        </tr>
@endisset
@isset($item->metaInfo->equip->tradeBlock)
        <tr>
            <td>Is trade blocked</td>
            <td>{{ $item->metaInfo->equip->tradeBlock == 1 ? 'true' : 'false' }}</td>
        </tr>
@endisset
@isset($item->metaInfo->equip->equipTradeBlock)
        <tr>
            <td>Is tradeblocked after equipped</td>
            <td>{{ $item->metaInfo->equip->equipTradeBlock == 1 ? 'true' : 'false' }}</td>
        </tr>
@endisset
@isset($item->metaInfo->equip->exItem)
        <tr>
            <td>Is an Exclusive/Unique item</td>
            <td>{{ $item->metaInfo->equip->exItem == 1 ? 'true' : 'false' }}</td>
        </tr>
@endisset
@isset($item->metaInfo->equip->charmEXP)
        <tr>
            <td>Increases charm by </td>
            <td>{{ $item->metaInfo->equip->charmEXP }}</td>
        </tr>
@endisset
@isset($item->metaInfo->equip->willEXP)
        <tr>
            <td>Increases willpower by </td>
            <td>{{ $item->metaInfo->equip->willEXP }}</td>
        </tr>
@endisset
@isset($item->metaInfo->equip->charismaEXP)
        <tr>
            <td>Increases charisma by </td>
            <td>{{ $item->metaInfo->equip->charismaEXP }}</td>
        </tr>
@endisset
@isset($item->metaInfo->equip->craftEXP)
        <tr>
            <td>Increases crafting by </td>
            <td>{{ $item->metaInfo->equip->craftEXP }}</td>
        </tr>
@endisset
@isset($item->metaInfo->equip->senseEXP)
        <tr>
            <td>Increases insight by </td>
            <td>{{ $item->metaInfo->equip->senseEXP }}</td>
        </tr>
@endisset
@isset($item->metaInfo->equip->tradeAvailable)
        <tr>
            <td>The type of trading that's available</td>
            <td>{{ GetTradeAvailable($item->metaInfo->equip->tradeAvailable) }}</td>
        </tr>
@endisset
@isset($item->metaInfo->equip->superiorEqp)
        <tr>
            <td>If the item is a superior equip</td>
            <td>{{ $item->metaInfo->equip->superiorEqp == 1 ? 'true' : 'false' }}</td>
        </tr>
@endisset
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
        <tr>
            <td>Is possible to move in account</td>
            <td>{{ $item->metaInfo->equip->accountSharable == 1 ? 'true' : 'false' }}</td>
        </tr>
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
        <tr>
            <td>Reward for fighting against bosses</td>
            <td>{{ $item->metaInfo->equip->bossReward == 1 ? 'true' : 'false' }}</td>
        </tr>
@endisset
@isset($item->metaInfo->equip->imdR)
        <tr>
            <td>The ignore defense this item gives</td>
            <td>{{ $item->metaInfo->equip->imdR }}%</td>
        </tr>
@endisset
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
@endisset
    </table>
</section>