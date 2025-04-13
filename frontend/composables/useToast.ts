// composables/use-toast.ts
export function useToast() {
    const toast = ({ title = "", description = "" }) => {
        alert(`${title}\n\n${description}`);
    };

    return { toast };
}
