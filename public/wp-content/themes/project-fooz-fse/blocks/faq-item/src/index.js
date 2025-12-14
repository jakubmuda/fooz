import { registerBlockType } from '@wordpress/blocks';
import { RichText, useBlockProps } from '@wordpress/block-editor';
import { useEffect } from '@wordpress/element';

registerBlockType('fooz/faq-item', {
    parent: ['fooz/faq'],
    edit({ attributes, setAttributes }) {
        const { question, answer, uid } = attributes;

        useEffect(() => {
            if (!uid) {
                setAttributes({
                    uid: Date.now().toString()
                });
            }
        }, [uid]);

        return (
            <div {...useBlockProps({ className: 'accordion-item' })}>
                <div className="accordion-header">
                    <button className="accordion-button collapsed" type="button">
                        <RichText
                            value={question}
                            onChange={(value) => setAttributes({ question: value })}
                            placeholder="Question"
                        />
                    </button>
                </div>

                <div className="accordion-body">
                    <RichText
                        tagName="div"
                        value={answer}
                        onChange={(value) => setAttributes({ answer: value })}
                        placeholder="Answer"
                    />
                </div>
            </div>
        );
    },

    save({ attributes }) {
        const { question, answer, uid } = attributes;
        const collapseId = `collapse-${uid}`;

        return (
            <div className="accordion-item">
                <div className="accordion-header">
                    <button
                        className="accordion-button collapsed"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target={`#${collapseId}`}
                        aria-expanded="false"
                        aria-controls={collapseId}
                    >
                        {question}
                    </button>
                </div>

                <div
                    id={collapseId}
                    className="accordion-collapse collapse"
                >
                    <div className="accordion-body">
                        {answer}
                    </div>
                </div>
            </div>
        );
    }
});
