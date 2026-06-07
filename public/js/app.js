document.addEventListener('DOMContentLoaded', () => {
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
    if (!csrfToken) {
        return;
    }

    let draggedCard = null;
    let sourceColumn = null;

    const taskCards = document.querySelectorAll('.task-card');
    const dropzones = document.querySelectorAll('.kanban-dropzone');

    taskCards.forEach((card) => {
        card.addEventListener('dragstart', (event) => {
            draggedCard = event.currentTarget;
            sourceColumn = draggedCard.closest('[data-column-status]');
            event.dataTransfer?.setData('text/plain', draggedCard.dataset.taskId || '');
            event.dataTransfer?.setDragImage(draggedCard, 20, 20);
            draggedCard.classList.add('opacity-50');
        });

        card.addEventListener('dragend', () => {
            draggedCard?.classList.remove('opacity-50');
            draggedCard = null;
            sourceColumn = null;
        });
    });

    dropzones.forEach((zone) => {
        zone.addEventListener('dragover', (event) => {
            event.preventDefault();
            zone.classList.add('ring-2', 'ring-yellow-400');
        });

        zone.addEventListener('dragleave', () => {
            zone.classList.remove('ring-2', 'ring-yellow-400');
        });

        zone.addEventListener('drop', async (event) => {
            event.preventDefault();
            zone.classList.remove('ring-2', 'ring-yellow-400');

            if (!draggedCard) {
                return;
            }

            const newStatus = zone.dataset.status;
            const taskId = draggedCard.dataset.taskId;
            const currentStatus = draggedCard.dataset.status;
            if (!taskId || !newStatus || currentStatus === newStatus) {
                return;
            }

            const originalParent = draggedCard.parentElement;
            zone.appendChild(draggedCard);
            draggedCard.dataset.status = newStatus;

            try {
                const response = await fetch(`/tasks/${taskId}/status`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({ status: newStatus }),
                });

                if (!response.ok) {
                    throw new Error('Status change failed');
                }

                updateColumnCounts();
            } catch (error) {
                if (originalParent) {
                    originalParent.appendChild(draggedCard);
                    draggedCard.dataset.status = currentStatus;
                }
                alert('Tidak bisa memindahkan tugas. Silakan coba lagi.');
            }
        });
    });

    function updateColumnCounts() {
        const columns = document.querySelectorAll('[data-column-status]');

        columns.forEach((column) => {
            const status = column.dataset.columnStatus;
            const countBadge = column.querySelector('.count-badge');
            const zone = column.querySelector(`[data-status="${status}"]`);
            if (!countBadge || !zone) {
                return;
            }

            const cardCount = zone.querySelectorAll('.task-card').length;
            countBadge.textContent = cardCount;
        });
    }
});
