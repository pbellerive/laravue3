<template>
    <div>

        <input id="frontVideo" name="frontVideo" type="file" class="">
        <t-button @click="upload()">ajouter</t-button>
        <!-- <iframe src="https://player.vimeo.com/video/525693435" width="100%" height="100%" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe> -->
        <div id="vplayer"></div>
    </div>
</template>


<script>
    import Player from '@vimeo/player';

    export default {
        methods: {
            upload() {
                var formData = new FormData();
                var imagefile = document.getElementById('frontVideo');

                formData.append("video", imagefile.files[0]);
                formData.append('exercise', JSON.stringify(this.exercise));

                axios.post('exercises/1/video', formData, { headers: {'Content-Type': 'multipart/form-data'}})
                    .then(response => {
                        this.$root.$refs.$notification.show({
                            'title': this.$i18n.t('saving'),
                            'text': this.$i18n.t('successfulSaving'),
                            'variant': 'success'
                        });
                    })
                    .catch(error => {
                       this.$root.$refs.$notification.show({
                            'title': this.$i18n.t('saving'),
                            'text': this.$i18n.t('errorOccur'),
                            'variant': 'success'
                        });
                    });
            }
        },
        mounted () {

            const player = new Player('vplayer', {
                id: 526091054,
                width: 640
            });

            player.on('play', function() {
                console.log('played the video!');
            });
        },
    }
</script>

<style lang="scss" scoped>

</style>