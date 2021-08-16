<template>
  <section>

  <div class="p-autofollow__container">
    <div class="p-autofollow__description">
      <p>「自動フォロー」ボタンをONにすると自動でフォローを実施します。</p>

      <!--自動フォロー実施中のみ表示されるテキスト-->
      <div class="p-autofollow__ongoing" v-show="ongoing">
        <h4>自動フォロー中です。</h4>
      </div>

      <!--自動フォローボタン。クリックでautofollowStartのon/off切替え-->
      <button class="p-autofollow__start" v-on:click="autofollowStart" v-bind:class='{nowfollow:ongoing}'>自動フォローON/OFF</button>
    </div>
  </div>

  <!--アカウント情報一覧。usersからforで表示。-->
  <div class="p-twiiter__container">
    <h2>仮想通貨アカウント一覧</h2>
    <div v-for="(user,index) in users" v-bind:key="index" class="c-card">
      <div class="c-card__header">
        <h4><a v-bind:href="'https://twitter.com/' + user.screen_name" target="_blank">{{ user.name }}</a></h4>
        <img v-bind:src="user.profile_image_url" alt="">
        フォロー数：{{user.friends_count}} フォロワー数：{{user.followers_count}}
      </div>
      <button v-on:click="follows(user,index)">@{{ user.screen_name }} をフォローする</button>
      <p>{{ user.description}}</p>
      <p>＜最新のツイート＞<br>
      {{user.status.text}}</p><br>
    </div>
  </div>

  </section>
</template>



<script>
export default{
    props:[
      'users', //利用ユーザーがフォローしていないアカウントの情報。Twitter認証してる時は出す。
      'follow_users', //ランダムにDB取得したユーザー情報
      'follow_ajax',//個別フォローするurlへのポストのurl
      'follow_all_ajax',//url情報。autofollow/all。
      'follow_check' //DB取得したautofollowの状態。1ならばtrueで自動フォロー中。
    ],
    data:function(){
      return{
        el: '#follows',
        reset_ok:true,
        ongoing:"", //自動フォロー実施中。trueであれば自動フォローON。
        users:this.users, //usersをusersに詰める。
        auto_status:this.follow_check
      }
    },
    mounted(){
      //自動フォローを実施しているか判定。1なら自動フォロー中で、ongoingをtrue。
      if(this.follow_check == 1){
        this.ongoing = true;
      }else{
        this.ongoing = false;
      }
    },
    methods:{
      //個別フォローのメソッド。
      //followコントローラーのfollowメソッドへフォロー対象のユーザーデータとともにajaxでアクセス。
      follow:function(user,index){
        const data = {
        user_id: user.id,
        user_name: user.screen_name,
        user_following: user.following
        }
        let self = this;
        let url = this.follow_ajax;
        axios.post(url, {
          data})
          .then((res)=>{
          alert('フォローしました。');
          this.users.splice(index,1)
          }).catch( error => { console.log(error); });
      },
      //自動フォローを切替た時にボタンを表示、「自動フォロー実施中です」の表示非表示を切替え。
      checkOngoing:function(){
        if(this.follow_check == 1 || true){
          this.ongoing = true;
        }else{
          this.ongoing = false;
        }
        //console.log(this.ongoing);
      },
      //まとめてフォロー（自動フォローのONOFF切替えメソッド）
      followStart:function(){
        let self = this;
        let url = this.follow_all_ajax;
        let auto_status = this.auto_status;
        //DB上のfollow状態が1の場合オートフォローを0にする
        if(self.auto_status == 1){
          //console.log(self.auto_status);
          this.ongoing = true;
          self.auto_status = 0;
        }else{
          //console.log(self.auto_status);
          this.ongoing = false;
          self.auto_status  = 1; //フォローが1ではない時、フォローを1にする
        }
          let request = self.auto_status;
          //console.log(request);
          axios.post(url, {
          request}).then((res)=>{
          alert('まとめてフォローの設定を切り替えました。ページを再読み込みします。');
          location.reload();
          }).catch( error => { console.log(error); });
      }
    },
    computed:{
      //個別フォローをした時にfollowingがfalseのユーザーを表示から削除する
      nofollow:function(){
      return this.users.filter(function(user){
      return user.following == false;
      });
     }
   }
}
</script>
