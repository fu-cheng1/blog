new Vue({
    el: '#FLY',
    data:{
        articleList:[]
    },
    methods:{
        findAll:function () {
            var url = 'list/findAll';
            var _this = this;
            axios.get(url).then(function (values) {
                _this.articleList = values.data
            })
        }
    },
    created:function () {
        this.findAll()
    }
});