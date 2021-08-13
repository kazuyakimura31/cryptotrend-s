<template>
<!--各ニュースをfor文でまわす-->
<section class="p-container__body">
      <div class="p-panel__group p-panel__group--flex">
        <div v-for="list in list_gn" class="p-panel p-panel__border p-panel__cnews">
          <div class="p-cnews__title">
            <a v-bind:href="list.url" target="_blank" class="u-ft__corp">{{ list.title }}</a>
          </div>
          <div class="p-cnews__date">
            <span>公開日時：{{ list.pubDate }}</span>
          </div>
          <div class="p-cnews__p">
            <a v-bind:href="list.url" class="p-cnews__jamp" target="_blank"><i class="far fa-arrow-alt-circle-right"></i>本文を読む</a><br>
          </div>

        </div>
      </div>
</section>

</template>




<script>
  export default {
    props:[
    'list_gn'
    ],
  mounted() {
    }
}
</script>
