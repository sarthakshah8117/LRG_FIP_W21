export default {
    name: "Users",

    props: ["tbl_user"],

    data: function() {
        return{
            Fname: this.tbl_user.user_fname,
            Lname: this.tbl_user.user_lname,
            Position: this.tbl_user.position
        }
    },

    template:
        `<section>
            <p>{{ tbl_user.user_fname }}</p>
            <p>{{ tbl_user.user_lname }}</p>
            <p>{{ tbl_user.position }}</p>
            <p>Test</p>
        </section>`,

    created: function() {
        console.log(`Added Users Data`);
    },

    methods: {

    },
}