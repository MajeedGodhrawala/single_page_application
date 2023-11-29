function has_permission(name = {}) {
    const permissions = JSON.parse(sessionStorage.getItem("user_permissions"));
    // const has_permission = Object.values(permissions).includes("view_profile");
    let has_permission = false;
    Object.entries(permissions).forEach(([key, value]) => {
        if (value.name == name) {
            has_permission = true;
        }
    });
    return has_permission;
}

//Export
export { has_permission };
