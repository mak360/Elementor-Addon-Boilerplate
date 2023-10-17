<?php
namespace ElementorEAB\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) {
    exit;
}
// Exit if accessed directly

class Test extends Widget_Base {

    public function get_name() {
        return 'eab-test';
    }

    public function get_title() {
        return __('test', 'eab');
    }

    public function get_icon() {
        return 'eicon-kit-details';
    }

    public function get_categories() {
        return ['eab-category'];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'section_title',
            [
                'label' => __('Test', 'eab'),
            ]
        );
        $this->add_control(
            'test_title',
            [
                'label'             => __('Title', 'ddmg'),
                'type'              => Controls_Manager::TEXT,
                'label_block'       => true,
                'default'           => '',
            ]
        );
        $this->add_control(
            'test_subtitle',
            [
                'label'             => __('Subtitle', 'ddmg'),
                'type'              => Controls_Manager::TEXT,
                'label_block'       => true,
                'default'           => '',
            ]
        );
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'question', [
                'label'             => __( 'Question', 'ddmg' ),
                'type'              => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'answer', [
                'label'             => __( 'Answer', 'ddmg' ),
                'type'              => \Elementor\Controls_Manager::WYSIWYG,
                'default'           => '',
            ]
        );
        
        $this->add_control(
            'list',
            [
                'label'             => __( 'FAQs', 'ddmg' ),
                'type'              => \Elementor\Controls_Manager::REPEATER,
                'fields'            => $repeater->get_controls(),
                'default'           => [
                    [
                        'name'         => __( 'Item #1', 'ddmg' ),
                    ]
                ],
                'title_field'       => '{{{ name }}}',
            ]
        );

        $this->end_controls_section();
    }
    
    
    protected function render() {
        $settings                            = $this->get_settings();
        $test_title                          = $this->get_settings('test_title');
        $test_subtitle                       = $this->get_settings('test_subtitle');
        $list                                = $this->get_settings('list');
        ?>
        
        <!-- start repeated content -->
        <section class="accordian-section">
            <div class="container">
                <h2>
                   <mark><?php echo $test_title; ?></mark>                    
                    <span><?php echo $test_subtitle; ?></span>
                </h2>
                <div class="accordion-row">
                    <?php foreach ($list as $r) { ?>                                
                        <div class="accordion-block">
                            <div class="accordion-content-block">
                                <h3><?php echo $r['question']; ?></h3>
                                <div class="ask-content">
                                    <?php echo $r['answer']; ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </section>        
        <!-- end repeated content -->

 
  
    <?php
    }

    protected function content_template() {

    }
}