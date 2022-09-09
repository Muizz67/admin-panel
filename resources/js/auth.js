export default class Auth{
    constructor() {
        this.user=user;
    }

    roles(){
        return this.user.roles.map(roles=>roles.name);
    }

    permissions(){
        return this.user.permissions.map(roles=>roles.name);
    }

    isAdmin(){
        return this.roles().includes("Admin");
    }

    can($permissionName){
        return true;
        return this.permissions().includes($permissionName);
    }
}