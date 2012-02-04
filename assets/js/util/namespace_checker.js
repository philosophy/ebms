com.ebms.util.namespace_checker = function(namespace) {
    var exists = false;
    try {
        exists = !!eval(namespace);
    } catch(e){}
    return exists;
};