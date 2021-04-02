import Users from "./modules/TheUsersList.js";

(() => {

    let vue_vm = new Vue({

        data: {
            usersList: [],
        },

        mounted: function() {
            console.log("Vue is mounted, trying a fetch for the initial data");
            
            fetchData("./includes/admin/index.php")
                .then(data => {
                    data.forEach(tbl_user => this.usersList.push(tbl_user));
                })
                .catch(err => console.error(err));
        },

        updated: function() {
            console.log('Vue just updated the DOM');
        },

        components: {
            "users-list": Users
        }
        
    }).$mount("#membershipMain");
})();