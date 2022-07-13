import swal from 'sweetalert';


export function useFlash() {
    
    function flash(title, message, type){
        return swal(title, message, type);
    }

    return { flash };
}