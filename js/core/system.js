var system = {
    __loaders: [],
    onLoad: function (fn) {
        system.__loaders.push(fn);
    },
    _triggerLoadedEvent: function() {
        for(let i = 0; i < system.__loaders.length; i++) {
            system.__loaders[i]();
        }
    },
    redirect: function (file, type, text) {

        if(type && text) {
            let msgs = [];

            if(localStorage.getItem('messages')) {
                msgs = JSON.parse(localStorage.getItem('messages'));
            }

            msgs.push({
                type: type,
                message: text
            });

            localStorage.setItem('messages', JSON.stringify(msgs));
        }
        window.location.href = file;
    },
    getUser: function(){
        try {
            let token = localStorage.getItem('token');
            let payload = token.split('.')[1];
            return JSON.parse(atob(payload));
        } catch(e) {
            return null;
        }
    },
    initialize: function (scriptsLoad) {
        var scriptLoaded = 0;
        var makeScriptLoad = function () {
            scriptLoaded++;
            if (scriptLoaded === scriptsLoad.length)
            system._triggerLoadedEvent();
        };

        for(let i = 0; i < scriptsLoad.length; i++) {
            $.getScript(scriptsLoad[i] + '?v=' + _version, function () {
                console.log('[Application] ' + scriptsLoad[i] +  ' loaded!');
                makeScriptLoad();
            }, function () {
                console.error('[Application] ' + scriptsLoad[i] +  ' not loaded!');
                makeScriptLoad();
            });
        }

        // exibindo mensagens
        try {
            let msgs = JSON.parse(localStorage.getItem('messages'));
            for(let i = 0; i < msgs.length; i++) {
                if(toastr[msgs[i]['type']]) {
                    toastr[msgs[i]['type']](msgs[i]['message'], 'Biblioteca');
                } else {
                    console.warn('O toastr não da suporte ao type "'+msgs[i]['type']+'" a mensagem "'+msgs[i]['message']+'" não será exibida.');
                }
                
            }

            localStorage.removeItem('messages');
        } catch (e) {}
    },
    
    getFormObject: function ($form){
        var unindexed_array = $form.serializeArray();
        var indexed_array = {};
    
        $.map(unindexed_array, function(n, i){
            indexed_array[n['name']] = n['value'];
        });
    
        return indexed_array;
    }
};
