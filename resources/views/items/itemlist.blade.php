@extends('layouts.app')

@section('title')
    Items
@endsection

@section('css')
<style>

ul {
    list-style: none;
    padding: 0;
}

li {
    min-height: 40px;
}

li span {
    display: inline-flex;
    align-items: center;
    font-weight: 400;
}

li img {
    flex-shrink: 0;
    margin-right: 8px;
}

form label {
    display: inline-flex;
    flex-direction: column;
    text-align: center;
    align-items: center;
    padding: 8px;
}

#minLevel input, #maxLevel input {
    max-width: 100px;
}

.center-form {
    text-align: center;
    padding: 8px 0;
}

input[type="number"], input[type="text"], input[type="reset"], input[type="submit"], select {
    padding: 6px;
    background: rgba(0, 0, 0, 0.4);
    border: 0px none transparent;
    box-shadow: inset 0 0 2px rgba(0, 0, 0, 0.8);
    border-radius: 4px;
    /* background: -moz-linear-gradient(top, rgba(0, 0, 0, 0.4), 0%, rgba(0, 0, 0, 0.2) 100%);
    background: -webkit-linear-gradient(top, rgba(0, 0, 0, 0.4) 0%,rgba(0, 0, 0, 0.2) 100%);
    background: linear-gradient(to bottom, rgba(0, 0, 0, 0.4) 0%,rgba(0, 0, 0, 0.2) 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='rgba(0, 0, 0, 0.4)', endColorstr='rgba(0, 0, 0, 0.2)',GradientType=0 ); */
    color: rgba(255, 255, 255, 0.7);
    text-shadow: 0 0 2px rgba(255, 255, 255, 0.2);

    display: inline-block;
    font-weight: 400;
    white-space: nowrap;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    border: 1px solid transparent;
    padding: .5rem .75rem;
    font-size: 1rem;
    line-height: 1.25;
    border-radius: .25rem;
}
.search-box {
    display: inline-block;
    font-weight: 400;
    white-space: nowrap;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    font-size: 1rem;
    line-height: 1.25;
    border-radius: .25rem;
}

input[type="reset"], input[type="submit"] {
    margin: 8px;
}

.count {
    width: 125px;
    height: 37px;
}
</style>
@endsection

@section('content')
<form method='get' action='/{{$region}}/{{$version}}/items'>
    <h3>
        Items <a href='/gms/latest/items' class="btn btn-soft">English</a> <a href='/kms/latest/items' class="btn btn-soft">한국어</a> <a href='/jms/latest/items' class='btn btn-soft'>日本語</a> <a href='/cms/latest/items' class='btn btn-soft'>中文</a>
        <span class="float-right search-box">
            <i class="fa fa-search fa-fw"></i>
            <input type='text' name='search' value='{{$oldQuery['search'] ?? ''}}'/>
            <select name='count' class="count">
                <option value='10' {{ (($oldQuery['count'] ?? 0) == 10) ? 'selected' : '' }}>10 Items</option>
                <option value='25' {{ (($oldQuery['count'] ?? 0) == 25) ? 'selected' : '' }}>25 Items</option>
                <option value='50' {{ (($oldQuery['count'] ?? 0) == 50) ? 'selected' : '' }}>50 Items</option>
                <option value='100' {{ (($oldQuery['count'] ?? 0) == 100) ? 'selected' : '' }}>100 Items</option>
                <option value='250' {{ (($oldQuery['count'] ?? 0) == 250) ? 'selected' : '' }}>250 Items</option>
                <option value='500' {{ (($oldQuery['count'] ?? 0) == 500) ? 'selected' : '' }}>250 Items</option>
            </select>
            <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                <i class="fa fa-cog"></i>
            </a>
        </span>
    </h3>
    <div class="collapse" id="collapseExample">
        <div class='center-form'>
            <label id='minLevel'>
                <span>Min Level</span>
                <input type='number' name='minLevel' value='{{$oldQuery['minLevel'] ?? ''}}' min="1" max="250" />
            </label>
            <label id='maxLevel'>
                <span>Max Level</span>
                <input type='number' name='maxLevel' value='{{$oldQuery['maxLevel'] ?? ''}}' min="1" max="250" />
            </label>
            <label id='job'>
                <span>Job</span>
                <select name='job'>
                    <option></option>
                    <option value='0' {{ (isset($oldQuery['job']) && in_array('0', $oldQuery['job']) ? 'selected' : '') }}>Beginner</option>
                    <option value='1' {{ (isset($oldQuery['job']) && in_array('1', $oldQuery['job']) ? 'selected' : '') }}>Warrior</option>
                    <option value='2' {{ (isset($oldQuery['job']) && in_array('2', $oldQuery['job']) ? 'selected' : '') }}>Magician</option>
                    <option value='4' {{ (isset($oldQuery['job']) && in_array('4', $oldQuery['job']) ? 'selected' : '') }}>Bowman</option>
                    <option value='8' {{ (isset($oldQuery['job']) && in_array('8', $oldQuery['job']) ? 'selected' : '') }}>Thief</option>
                    <option value='16' {{ (isset($oldQuery['job']) && in_array('16', $oldQuery['job']) ? 'selected' : '') }}>Pirate</option>
                </select>
            </label>
            <div class='categoryContainer'>
                <label id='cash'>
                    <span>Cash Filter</span>
                    <input type='checkbox' name='cash' {{ ($oldQuery['cash'] ? 'checked' : '') }} />
                </label>
            </div>
            <input type='reset' value='Restore filter' />
            <input type='submit' value='Apply filter' />
        </div>
    </div>
</form>

<section>
    <ul>
        @empty($items)
            <li>No items could be found :(</li>
        @else
        <div class="items row">
            <div class="size col-md-6 col-lg-4 col-sm-12 d-none"></div>
        @foreach($items as $item)
            <div class="item col-md-6 col-lg-4 col-sm-12">
                <div class="card mb-1 mr-1">
                    <div class="card-body p-2" style="overflow:hidden;">
                        <a href='/{{$region}}/{{$version}}/item/{{$item->id}}'>
                        <span data-required-jobs='{{implode($item->requiredJobs ?? [], ', ')}}' data-is-cash='{{$item->isCash}}' data-required-gender='{{$item->requiredGender}}' data-required-level='{{$item->requiredLevel}}'>
                            <img src='https://maplestory.io/api/{{$region}}/{{$version}}/item/{{$item->id}}/icon' />
                            <span style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;width:100%;">{{ $item->name }}</span><br/>
                        </a>
                            <span class="category"><span class="badge badge-info">{{ $item->typeInfo->overallCategory }}</span> {{ $item->typeInfo->category }} <i class="fa fa-chevron-right"></i> {{ $item->typeInfo->subCategory }}</span>
                        </span>

                    </div>
                </div>
            </div>
        @endforeach
        </div>
        @endempty
    </ul>
</section>
@endsection

@section('js')
<script>
/**
 * jQuery Unveil
 * A very lightweight jQuery plugin to lazy load images
 * http://luis-almeida.github.com/unveil
 *
 * Licensed under the MIT license.
 * Copyright 2013 Luís Almeida
 * https://github.com/luis-almeida
 */

 ;(function($) {

  $.fn.unveil = function(threshold, callback) {

    var $w = $(window),
        th = threshold || 0,
        retina = window.devicePixelRatio > 1,
        attrib = retina? "data-src-retina" : "data-src",
        images = this,
        loaded;

    this.one("unveil", function() {
      var source = this.getAttribute(attrib);
      source = source || this.getAttribute("data-src");
      if (source) {
        this.setAttribute("src", source);
        if (typeof callback === "function") callback.call(this);
      }
    });

    function unveil() {
      var inview = images.filter(function() {
        var $e = $(this);
        if ($e.is(":hidden")) return;

        var wt = $w.scrollTop(),
            wb = wt + $w.height(),
            et = $e.offset().top,
            eb = et + $e.height();

        return eb >= wt - th && et <= wb + th;
      });

      loaded = inview.trigger("unveil");
      images = images.not(loaded);
    }

    $w.on("scroll.unveil resize.unveil lookup.unveil", unveil);

    unveil();

    return this;

  };

})(window.jQuery || window.Zepto);

$(document).ready(function() {
  $("img").unveil();
});

$(document).ready(function () {
    var itemCategories = {!! json_encode($categories) !!};
    var selectedOverallCategory = '{{ $oldQuery['overallCategory'] ?? '' }}'
    var selectedCategory = '{{ $oldQuery['category'] ?? '' }}'
    var selectedSubCategory = '{{ $oldQuery['subCategory'] ?? '' }}'

    function GenerateSelect(values, name, selected, labelText) {
        var options = []
        if (values.length)
            options = values.map(function (item) { return item.item1; })
        else
            options = Object.keys(values)

        options.splice(0, 0, '')

        var optionElements = options.map(function (option) {
            var $option = $('<option value="'+option+'">'+option+'</option>')
            if (option == selected) $option.attr('selected', 'selected')
            return $option
        })

        var selectElement = $('<select name="'+name+'" />');
        selectElement.append(optionElements)

        var labelElement = $('<label id="'+name+'" />')
        if (labelText)
            labelElement.append('<span>'+labelText+'</span>')
        labelElement.append(selectElement)

        return labelElement
    }

    var itemTypeLabel = GenerateSelect(itemCategories, 'overallCategory', selectedOverallCategory, 'Item Type')
    var itemType = itemTypeLabel.find('select'),
        $categoriesLabel = null,
        $subCategoriesLabel = null,
        $categories = null,
        $subCategories = null

    function showCategories() {
        var selectedItemType = itemType.val()
        var categories = itemCategories[selectedItemType]

        if (!categories) return

        $categoriesLabel = GenerateSelect(categories, 'category', selectedCategory, 'Category').on('change', showSubCategories)
        $categories = $categoriesLabel.find('select')
        $('#category, #subCategory').remove()
        $('#overallCategory').after($categoriesLabel)
        showSubCategories()
    }

    function showSubCategories() {
        var selectedItemType = itemType.val()
        var selectedCategory = $categories.val()
        var subCategories = itemCategories[selectedItemType][selectedCategory]

        if (!subCategories) return

        $subCategoriesLabel = GenerateSelect(subCategories, 'subCategory', selectedSubCategory, 'Sub-category')
        $subCategories = $subCategoriesLabel.find('select')
        $('#subCategory').remove()
        $('#category').after($subCategoriesLabel)
    }

    itemType.on('change', showCategories)

    $('form .categoryContainer').append(itemTypeLabel)

    showCategories()
})

</script>

    <script type="text/javascript">
        var iso = new Isotope( '.items', {
            itemSelector: '.item', // use a separate class for itemSelector, other than .col-
            layoutMode: 'masonry',
            masonry: {
            gutter: 0,
            columnWidth: .size
            }
        });
    </script>
@endsection